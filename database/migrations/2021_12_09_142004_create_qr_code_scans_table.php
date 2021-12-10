<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrCodeScansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qr_code_scans', function (Blueprint $table) {
            $table->id();
            $table->integer('restaurant_id')->required()->index();
            $table->integer('week1')->nullable();
            $table->integer('week2')->nullable();
            $table->integer('week3')->nullable();
            $table->integer('week4')->nullable();
            $table->integer('week5')->nullable();
            $table->integer('week6')->nullable();
            $table->integer('week7')->nullable();
            $table->integer('week8')->nullable();
            $table->integer('week9')->nullable();
            $table->integer('week10')->nullable();
            $table->integer('week11')->nullable();
            $table->integer('week12')->nullable();
            $table->integer('week13')->nullable();
            $table->integer('week14')->nullable();
            $table->integer('week15')->nullable();
            $table->integer('week16')->nullable();
            $table->integer('week17')->nullable();
            $table->integer('week18')->nullable();
            $table->integer('week19')->nullable();
            $table->integer('week20')->nullable();
            $table->integer('week21')->nullable();
            $table->integer('week22')->nullable();
            $table->integer('week23')->nullable();
            $table->integer('week24')->nullable();
            $table->integer('week25')->nullable();
            $table->integer('week26')->nullable();
            $table->integer('week27')->nullable();
            $table->integer('week28')->nullable();
            $table->integer('week29')->nullable();
            $table->integer('week30')->nullable();
            $table->integer('week31')->nullable();
            $table->integer('week32')->nullable();
            $table->integer('week33')->nullable();
            $table->integer('week34')->nullable();
            $table->integer('week35')->nullable();
            $table->integer('week36')->nullable();
            $table->integer('week37')->nullable();
            $table->integer('week38')->nullable();
            $table->integer('week39')->nullable();
            $table->integer('week40')->nullable();
            $table->integer('week41')->nullable();
            $table->integer('week42')->nullable();
            $table->integer('week43')->nullable();
            $table->integer('week44')->nullable();
            $table->integer('week45')->nullable();
            $table->integer('week46')->nullable();
            $table->integer('week47')->nullable();
            $table->integer('week48')->nullable();
            $table->integer('week49')->nullable();
            $table->integer('week50')->nullable();
            $table->integer('week51')->nullable();
            $table->integer('week52')->nullable();
            
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
        Schema::dropIfExists('qr_code_scans');
    }
}
