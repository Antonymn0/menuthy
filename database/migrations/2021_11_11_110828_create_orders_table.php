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
            $table->bigInteger('order_number')->required();
            $table->double('amount')->required();
            $table->string('paid')->required();
            $table->string('delivery_address')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('car_registration_no')->nullable();
            $table->double('amount_paid')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->integer('number_of_items')->required();
            $table->integer('table_number')->required();
            $table->string('status')->required();
            $table->string('order_type')->required();
            $table->string('transaction_id')->nullable();
            $table->integer('restaurant_id')->required();
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
        Schema::dropIfExists('orders');
    }
}
