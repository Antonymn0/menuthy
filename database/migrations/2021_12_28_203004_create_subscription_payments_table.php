<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->required();
            $table->string('email')->nullable();
            $table->string('reciept_email')->nullable();
            $table->string('reciept_number')->nullable();
            $table->string('currency')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('paid')->nullable();
            $table->string('payment_intent')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('card_type')->nullable();
            $table->string('reciept_url')->required();
            $table->string('status')->nullable();
            $table->double('amount_paid')->required();
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
        Schema::dropIfExists('subscription_payments');
    }
}
