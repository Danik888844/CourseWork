<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersIp extends Migration
{

    public function up()
    {
        Schema::create('users_ip', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->integer('viewed_post_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users_ip');
    }
}
