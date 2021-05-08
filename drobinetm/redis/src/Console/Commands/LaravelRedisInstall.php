<?php

namespace Drobinetm\Redis\Console\Commands;

use Illuminate\Console\Command;

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
    protected $description = 'Install migrations and properties of the security with this library';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
