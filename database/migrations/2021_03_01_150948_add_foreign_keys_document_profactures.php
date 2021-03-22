<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysDocumentProfactures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('profacture_id')->references('id')->on('profactures')->onUpdate('cascade');
            $table->foreign('public_doc_id')->references('id')->on('documents')->onUpdate('cascade');

        });

        Schema::table('profactures',function(Blueprint $table){
            $table->foreign('public_doc_id')->references('id')->on('documents')->onUpdate('cascade');
            $table->foreign('private_doc_id')->references('id')->on('documents')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            //
        });
    }
}
