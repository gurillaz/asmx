<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profactures', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('public_doc_id')->nullable();
            $table->unsignedBigInteger('private_doc_id')->nullable();

            $table->text('comment')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('list_type_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('list_type_id')->references('id')->on('list_types')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade');


            $table->timestamps();

        });

        DB::update("ALTER TABLE profactures AUTO_INCREMENT = 10000;");



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profactures');
    }
}
