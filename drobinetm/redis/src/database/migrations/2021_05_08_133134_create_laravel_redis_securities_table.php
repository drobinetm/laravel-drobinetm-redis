<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaravelRedisSecuritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('laravel_redis_securities')) {
            Schema::create('laravel_redis_securities', function (Blueprint $table) {
                $table->increments('id');
                $table->string('clientId', 255);
                $table->string('clientSecret', 255);
                $table->text('token');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('laravel_redis_securities')) {
            Schema::dropIfExists('laravel_redis_securities');
        }
    }
}
