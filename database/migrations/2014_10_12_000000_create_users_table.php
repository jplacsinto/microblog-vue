<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $oTable) {
            $oTable->id();
            $oTable->string('name', 50);
            $oTable->string('username', 100)->unique();
            $oTable->string('password')->nullable();
            $oTable->string('auth_provider')->nullable();
            $oTable->string('auth_provider_id')->nullable();
            $oTable->rememberToken();
            $oTable->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
