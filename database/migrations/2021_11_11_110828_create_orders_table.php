<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('menu_item_name')->required();
            $table->string('menu_item_type')->required();
            $table->integer('menu_item_id')->required();
            $table->integer('is_take_away')->required();
            $table->integer('is_inhouse')->required();
            $table->double('price')->required();
            $table->string('preperation_time')->required();
            $table->string('state')->required();
            $table->text('accompaniments')->required();
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
        Schema::dropIfExists('orders');
    }
}
