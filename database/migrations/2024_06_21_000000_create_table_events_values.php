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
        Schema::create('events_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_index')->nullable();
            $table->foreign('id_index')->references('id')->on('index_catalog')->onDelete('cascade');
            $table->unsignedBigInteger('id_event')->nullable();
            $table->foreign('id_event')->references('id')->on('events')->onDelete('cascade');
            $table->string('code_uuid')->nullable();
            $table->string('customer_uuid')->nullable();
            $table->string('url')->nullable();
            $table->double('value_numeric')->nullable();
            $table->text('value_text')->nullable();
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
        Schema::dropIfExists('events_values', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_index');
            $table->dropConstrainedForeignId('id_event');
        });
        Schema::dropIfExists('events_values');
    }
};