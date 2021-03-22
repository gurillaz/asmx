<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('email')->nullable();
            $table->string('client_type')->nullable();
            $table->unsignedInteger('credit_limit');
            $table->unsignedInteger('payment_limit_days');
            $table->unsignedDouble('price_increase_quota')->default('1');

            $table->unsignedBigInteger('price_level_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');


            $table->foreign('price_level_id')->references('id')->on('price_levels')->onUpdate('cascade');
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
        Schema::dropIfExists('clients');
    }
}
