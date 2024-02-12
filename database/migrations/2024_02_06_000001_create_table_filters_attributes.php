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
        Schema::create('filters_attributes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_index')->nullable();
            $table->foreign('id_index')->references('id')->on('index_catalog')->onDelete('cascade');
            $table->unsignedBigInteger('id_attribute')->nullable();
            $table->foreign('id_attribute')->references('id')->on('attributes')->onDelete('cascade');
            $table->integer('sort');
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
        Schema::dropIfExists('filters_attributes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_index');
            $table->dropConstrainedForeignId('id_attribute');
        });
        Schema::dropIfExists('filters_attributes');
    }
};