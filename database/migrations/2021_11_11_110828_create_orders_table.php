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
            $table->string('menu_item_type')->nullable();
            $table->string('restaurant_id')->required();
            $table->integer('menu_item_id')->required();
            $table->integer('order_number')->required();
            $table->string('is_take_away')->nullable();
            $table->string('is_inhouse')->nullable();
            $table->double('price')->required();
            $table->integer('preparation_time')->required();
            $table->string('status')->required();
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
