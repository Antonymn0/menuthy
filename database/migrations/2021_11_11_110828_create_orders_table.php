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
             $table->double('price')->required();
            $table->integer('preparation_time')->required();
            $table->string('status')->required();
            $table->string('restaurant_id')->required();
            $table->integer('menu_item_id')->required();
            $table->integer('table_number')->required();
            $table->bigInteger('order_number')->required();
            $table->string('menu_item_type')->nullable();
            $table->string('is_take_away')->nullable();
            $table->string('is_inhouse')->nullable();
            $table->text('accompaniments')->nullable();
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
