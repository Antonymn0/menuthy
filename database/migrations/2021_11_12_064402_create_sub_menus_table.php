<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_menus', function (Blueprint $table) {
            $table->id();
            $table->string('sub_menu_name')->required();
            $table->string('sub_menu_type')->nullable();
            $table->integer('menu_id')->required(); //foreign key
            $table->integer('restaurant_id')->required(); //foreign key
            $table->string('availability')->nullable(); 
            $table->string('is_new')->nullable(); 
            $table->string('is_signiture')->nullable(); 
            $table->string('publish')->nullable(); 
            $table->string('take_away')->nullable(); 
            $table->string('inhouse')->nullable(); 
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
        Schema::dropIfExists('sub_menus');
    }
}
