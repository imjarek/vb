<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBwUsersTable extends Migration
{
    public function up()
    {
        Schema::create('bw_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vk_user_id');
            $table->integer('bw_user_id')->nullable();
            $table->string('token')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bw_users');
    }
}
