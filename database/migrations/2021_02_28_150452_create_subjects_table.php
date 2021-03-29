<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fiscal_no')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();

            $table->enum('subject_type',['supplier','client','other']);

            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('email')->nullable();



            $table->text('info')->nullable();


            $table->string('website')->nullable();
            $table->unsignedInteger('credit_limit')->nullable();
            $table->unsignedInteger('payment_limit_days')->nullable();
            $table->unsignedDouble('price_increase_quota')->default('1');

            $table->unsignedBigInteger('price_level_id')->nullable();

            $table->unsignedBigInteger('user_id');



            $table->foreign('price_level_id')->references('id')->on('price_levels')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');

            $table->timestamps();



        });

        DB::update("ALTER TABLE subjects AUTO_INCREMENT = 100;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
