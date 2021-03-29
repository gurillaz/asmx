<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BrandSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('brand_subject', function (Blueprint $table) {

            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('subject_id');


            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade');


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
        //

        Schema::dropIfExists('brand_subject');

    }
}
