<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name')->required();
            $table->string('restaurant_type')->required();
            $table->foreignId('user_id')->required()->references('id')->on('users')->onDelete('cascade');
            $table->string('country')->required();
            $table->string('county')->required();
            $table->string('city')->required();
            $table->string('address')->nullable();
            $table->string('restaurant_phone_number')->nullable();
            $table->string('restaurant_email')->nullable();
            $table->string('is24/7')->nullable();
            $table->dateTime('opening_hrs')->nullable();
            $table->dateTime('closing_hrs')->nullable();
            $table->integer('offer_accomodation')->nullable();
            $table->string('slang')->nullable();
            $table->text('description')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamp('deleted_at')->nullable();


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
        Schema::dropIfExists('restaurants');
    }
}
