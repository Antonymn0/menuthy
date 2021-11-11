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
            $table->string('category')->required();
            $table->foreignId('restaurant_id')->required()->refferences('id')->on('restaurants')->onDelete('cascade');
            $table->string('availability')->required();
            $table->integer('take_away')->required();
            $table->integer('in_house')->required();
            $table->string('available_days')->required();
            $table->string('slang')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
