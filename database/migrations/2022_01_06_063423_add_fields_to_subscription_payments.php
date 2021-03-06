<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSubscriptionPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::table('subscription_payments', function (Blueprint $table) {
            // $table->string('package_type')->nullable();
            // $table->string('package_period')->nullable();
            // $table->dateTime('registration_expiry')->nullable();
            // $table->dateTime('registration_date')->nullable();
            // $table->timestamp('deleted_at')->nullable(); 

            $table->string('reconciled_to')->nullable(); 
            $table->string('reconciled')->nullable(); 
            $table->timestamp('reconciled_at')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_payments', function (Blueprint $table) {
            //
        });
    }
}
