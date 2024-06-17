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
        Schema::create('wesite_customer_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_client')->nullable();
            $table->foreign('id_client')->references('id')->on('client')->onDelete('cascade');
            $table->unsignedBigInteger('id_wesite_customer')->nullable();
            $table->foreign('id_wesite_customer')->references('id')->on('wesite_customer')->onDelete('cascade');
            $table->double('total')->nullable();
            $table->double('sub_total')->nullable();
            $table->double('discount')->nullable();
            $table->double('total_paid')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('wesite_customer_sales', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_client');
            $table->dropConstrainedForeignId('wesite_customer');
        });
        Schema::dropIfExists('wesite_customer_sales');
    }
};