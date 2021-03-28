<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
            {
            Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('second_name')->nullable();
            $table->string('stock_no')->unique();
            $table->string('original_no');
            $table->string('supplier_no');
            $table->string('producer_no');
            $table->string('barcode')->nullable();
            $table->enum('quality',['0','1','2','3','4','5'])->nullable();
            $table->double('weight')->default(0);
            $table->text('info')->nullable();
            $table->unsignedInteger('picies_in_set')->nullable();
            $table->unsignedDouble('buying_price');
            $table->unsignedDouble('cost');
            $table->unsignedDouble('tax_rate');
            $table->unsignedDouble('fixed_selling_price')->nullable();

            $table->decimal('stock')->nullable();

            $table->unsignedDecimal('minimal_stock')->nullable();
            $table->unsignedDecimal('maximal_stock')->nullable();

            $table->enum('active',['TRUE','FALSE'])->default('TRUE');
            $table->enum('public',['TRUE','FALSE']);

            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('measuring_unit_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('user_id');


            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->foreign('measuring_unit_id')->references('id')->on('measuring_units')->onUpdate('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade');

            $table->timestamps();

        });

        DB::update("ALTER TABLE products AUTO_INCREMENT = 10000;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
