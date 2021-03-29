<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('profacture_id')->nullable();

            $table->unsignedBigInteger('public_doc_id')->nullable();




            $table->text('comment')->nullable();
            $table->string('status')->nullable();



            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('document_type_id');


            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('document_type_id')->references('id')->on('document_types')->onUpdate('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade');



            $table->timestamps();

        });

        DB::update("ALTER TABLE documents AUTO_INCREMENT = 10000;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
