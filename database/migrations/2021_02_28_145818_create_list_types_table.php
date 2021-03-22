<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_types', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->text('info')->nullable();
            $table->enum('stock_type',['IN','OUT']);
            $table->enum('public',['TRUE','FALSE']);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');


            $table->timestamps();
        });

        DB::update("ALTER TABLE list_types AUTO_INCREMENT = 10;");



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_types');
    }
}
