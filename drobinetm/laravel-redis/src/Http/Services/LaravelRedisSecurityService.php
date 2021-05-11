<?php

namespace Drobinetm\LaravelRedis\Http\Services;

use Drobinetm\LaravelRedis\Models\LaravelRedisSecurity;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Str;

class LaravelRedisSecurityService
{
    protected $laravelRedisSecurity;

    /**
     * LaravelRedisSecurityService constructor
     **/
    public function __construct()
    {
        try {
            $this->laravelRedisSecurity = LaravelRedisSecurity::first();
        } catch (Exception $e) {
            $this->laravelRedisSecurity = NULL;
        }
    }

    /**
     * Validate Signature
     *
     * @param $signature
     * @return bool
     * @throws Exception
     */
    public function isSignatureValid($signature)
    {
        if (!isset($this->laravelRedisSecurity)) {
            throw new Exception("The clientId and the clientSecret do not exist in the database. Please run the command: laravel-redis:install");
        }

        // From database
        $clientId = $this->laravelRedisSecurity->clientId;
        $clientSecret = $this->laravelRedisSecurity->clientSecret;
        $signatureSecret = hash_hmac('sha256', json_encode(['clientId' => $clientId, 'clientSecret' => $clientSecret]), $clientSecret);

        $tokenSecret = $this->laravelRedisSecurity->token;
        $tokenSignature = Crypt::decryptString($tokenSecret);

        return ($signature === $signatureSecret && $signature === $tokenSignature);
    }

    /**
     * Get security data
     *
     * @return array
     */
    public function release()
    {
        if (!isset($this->laravelRedisSecurity))
        {
            $this->laravelRedisSecurity = new LaravelRedisSecurity();
        }

        $security = $this->security();

        $this->laravelRedisSecurity->clientId = $security['clientId'];
        $this->laravelRedisSecurity->clientSecret = $security['clientSecret'];
        $this->laravelRedisSecurity->token = $security['token'];
        $this->laravelRedisSecurity->save();

        return $security;
    }

    private function security()
    {
        $clientId = $this->clientId();
        $clientSecret = $this->clientSecret();

        $signature = hash_hmac('sha256', json_encode(['clientId' => $clientId, 'clientSecret' => $clientSecret]), $clientSecret);
        $token = Crypt::encryptString($signature);

        return [
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'signature' => $signature,
            'token' => $token,
        ];
    }

    private function clientId()
    {
        return $this->hashText(Str::random(32));
    }

    private function clientSecret()
    {
        return $this->hashText(Str::random(64));
    }

    private function hashText($text)
    {
        return Hash::make($text, [
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);
    }
}
