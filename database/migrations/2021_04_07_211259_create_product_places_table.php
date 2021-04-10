<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_places', function (Blueprint $table) {
            $table->id();
            $table->text('place_no');
            $table->string('comment')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');



            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');


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
        Schema::dropIfExists('product_places');
    }
}
