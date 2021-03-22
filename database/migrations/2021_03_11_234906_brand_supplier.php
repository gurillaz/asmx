<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BrandSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_supplier', function (Blueprint $table) {

            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('supplier_id');


            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade');


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
        Schema::dropIfExists('brand_supplier');
    }
}
