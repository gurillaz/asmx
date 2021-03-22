<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductProfacture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_profacture', function (Blueprint $table) {

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('profacture_id');

            $table->unsignedInteger('product_order_no');
            $table->string('custom_product_name');
            $table->unsignedDouble('quantity');
            $table->float('price');
            $table->float('discount');

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
            $table->foreign('profacture_id')->references('id')->on('profactures')->onUpdate('cascade');


            //TODO add timestamps

            //TODO add timestamps
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
        Schema::dropIfExists('product_profacture');

    }
}
