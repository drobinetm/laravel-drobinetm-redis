<?php

namespace Drobinetm\LaravelRedis\Http\Services;

use Drobinetm\LaravelRedis\Models\LaravelRedisSecurity;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Exception;

class LaravelRedisSecurityService
{
    protected $laravelRedisSecurity;

    /**
     * LaravelRedisSecurityService constructor
     **/
    public function __construct()
    {
        $this->laravelRedisSecurity = LaravelRedisSecurity::first();
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

    private function clientId()
    {
        return $this->hashText(str_random(36));
    }

    private function clientSecret()
    {
        return $this->hashText(str_random(64));
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