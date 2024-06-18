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
        Schema::create('funnel_item_event', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_event')->nullable();
            $table->foreign('id_event')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('id_funnel')->nullable();
            $table->foreign('id_funnel')->references('id')->on('funnel')->onDelete('cascade');
            $table->unsignedBigInteger('id_index')->nullable();
            $table->foreign('id_index')->references('id')->on('index_catalog')->onDelete('cascade');
            $table->unsignedBigInteger('id_client')->nullable();
            $table->foreign('id_client')->references('id')->on('client')->onDelete('cascade');
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
        Schema::dropIfExists('funnel_item_event', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_event');
            $table->dropConstrainedForeignId('id_funnel');
            $table->dropConstrainedForeignId('id_index');
            $table->dropConstrainedForeignId('id_client');
        });
        Schema::dropIfExists('funnel_item_event');
    }
};