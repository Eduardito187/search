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
        Schema::create('backup_query', function (Blueprint $table) {
            $table->unsignedBigInteger('id_index')->nullable();
            $table->foreign('id_index')->references('id')->on('index_catalog')->onDelete('cascade');
            $table->string('customer_uuid');
            $table->string('query');
            $table->integer('count_result');
            $table->longText('list_products');
            $table->longText('filters');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('backup_query', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_index');
        });
        Schema::dropIfExists('backup_query');
    }
};