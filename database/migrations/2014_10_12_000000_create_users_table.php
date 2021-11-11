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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->required();
            $table->string('first_name')->required();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->required();
            $table->string('user_name')->required()->unique();
            $table->string('email')->required()->unique();
            $table->string('phone')->required()->unique();
            $table->string('address')->nullable();
            $table->text('biography')->nullable();
            $table->string('password')->required();
            $table->dateTime('dob')->nullable();
            $table->string('county')->nullable();
            $table->string('city')->nullable();
            $table->string('location')->nullable();
            $table->timestamp('suspended_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('regn_status')->nullable();
            $table->integer('suspended_by')->nullable()->index();
            $table->string('avatar')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('name');          
            
            $table->rememberToken();
            $table->timestamps();
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
