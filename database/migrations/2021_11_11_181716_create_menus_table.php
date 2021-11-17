<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name')->required();
            $table->string('category')->nullable();
            $table->foreignId('restaurant_id')->required(); // ->refferences('id')->on('restaurants')->onDelete('cascade');
            $table->string('availability')->nullable();
            $table->integer('take_away')->nullable();
            $table->integer('in_house')->nullable();
            $table->string('available_days')->nullable();
            $table->string('slang')->nullable();
            $table->integer('published')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('image')->nullable();
            $table->string('avatar')->nullable();
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
        Schema::dropIfExists('menus');
    }
}
