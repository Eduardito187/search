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
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_client')->nullable();
            $table->foreign('id_client')->references('id')->on('client')->onDelete('cascade');
            $table->unsignedBigInteger('value_type')->nullable();
            $table->foreign('value_type')->references('id')->on('type_attribute')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
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
        Schema::dropIfExists('events', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_client');
            $table->dropConstrainedForeignId('value_type');
        });
        Schema::dropIfExists('events');
    }
};