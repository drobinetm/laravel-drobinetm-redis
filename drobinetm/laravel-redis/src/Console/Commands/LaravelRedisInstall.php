<?php

namespace Drobinetm\LaravelRedis\Console\Commands;

use Drobinetm\LaravelRedis\Http\Services\LaravelRedisSecurityService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class LaravelRedisInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-redis:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install migrations and properties for this library.';

    /**
     * The Laravel Redis Security Service object.
     *
     * @var LaravelRedisSecurityService
     */
    protected $laravelRedisSecurityService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->laravelRedisSecurityService = new LaravelRedisSecurityService();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Run migration
        Artisan::call('migrate', ['--path' => __DIR__ . '../../database/migrations/2021_05_08_133134_create_laravel_redis_securities_table.php']);

        // Generate security properties and save on database
        $properties = $this->laravelRedisSecurityService->release();

        $this->info("ClientId: {$properties['clientId']}");
        $this->info("ClientSecret: {$properties['clientSecret']}");
        $this->info("Signature: {$properties['signature']}");
    }
}
