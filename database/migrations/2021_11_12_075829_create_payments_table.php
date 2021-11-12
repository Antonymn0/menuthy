<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->required(); // foreign key
            $table->double('amount_due')->required();
            $table->double('amount_paid')->required();
            $table->double('discount_amount')->required();
            $table->string('status')->required();
            $table->string('payment_method')->required();
            $table->string('transaction_id')->required()->unique();
            $table->string('customer_name')->required();
            $table->timestamp('transaction_date')->required();
            $table->integer('table_number')->nullable();
            $table->string('payee_account_number')->required();
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
        Schema::dropIfExists('payments');
    }
}
