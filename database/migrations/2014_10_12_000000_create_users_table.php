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
            $table->string('email')->required()->unique();
            $table->string('password')->required();
            $table->string('user_name')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('registration_status')->nullable()->default('trial');
            $table->string('package_type')->nullable();
            $table->dateTime('trial_expiry')->nullable();
            $table->dateTime('registration_expiry')->nullable();
            $table->string('address')->nullable();
            $table->text('biography')->nullable();
            $table->dateTime('dob')->nullable();
            $table->string('county')->nullable();
            $table->string('city')->nullable();
            $table->string('location')->nullable();
            $table->timestamp('suspended_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('tables')->nullable()->default(1);
            $table->integer('suspended_by')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('name')->nullable();          
            $table->string('image')->nullable();          
            
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
