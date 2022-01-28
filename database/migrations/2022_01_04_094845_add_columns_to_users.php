<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('package_period')->nullable();
            // $table->dateTime('trial_date')->nullable();
            // $table->dateTime('registration_date')->nullable();
            
            // $table->text('stripe_publishable_key')->nullable();
            // $table->text('stripe_secret_key')->nullable();
            // $table->dateTime('stripe_info_updated_at')->nullable();

            $table->integer('created_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
