<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryAddressToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // $table->timestamp('completed_at')->nullable();
            // $table->timestamp('canceled_at')->nullable();
            // $table->string('delivery_address')->nullable();
            // $table->string('longitude')->nullable();
            // $table->string('latitude')->nullable();
            // $table->dateTime('delivered_at')->nullable();
            //  $table->string('cash_collected')->nullable();
            //  $table->double('amount_collected')->nullable();
            //  $table->dateTime('cash_collected_at')->nullable();

            $table->string('mode_of_payment')->nullable();
            $table->string('stripe_session_id')->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
