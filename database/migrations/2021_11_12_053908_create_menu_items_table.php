<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('menu_item_name')->required();
            $table->string('menu_item_type')->required();
            $table->string('availability')->required();
            $table->integer('take_away')->required();
            $table->integer('sub_menu_id')->required(); // foreign key
            $table->integer('inhouse')->required(); 
            $table->double('price')->required();  
            $table->double('discount')->nullable(); 
            $table->string('preperation_time')->required(); 
            $table->string('available_days')->nullable(); 
            $table->string('slang')->nullable(); 
            $table->text('description')->nullable();
            $table->string('image')->nullable(); 
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
        Schema::dropIfExists('menu_items');
    }
}
