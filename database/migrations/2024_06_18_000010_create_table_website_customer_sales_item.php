<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_customer_sales_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_website_customer_sales')->nullable();
            $table->foreign('id_website_customer_sales')->references('id')->on('website_customer_sales')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->double('price')->nullable();
            $table->double('discount')->nullable();
            $table->double('qty')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_customer_sales_item', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_website_customer_sales');
        });
        Schema::dropIfExists('website_customer_sales_item');
    }
};