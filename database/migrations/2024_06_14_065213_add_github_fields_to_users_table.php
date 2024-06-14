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
        Schema::table('customers_account', function (Blueprint $table) {
            $table->string('github_id')->nullable()->unique();
            $table->string('avatar')->nullable();
            $table->string('github_nickname')->nullable();
            $table->string('token')->nullable();
        });
    }

    public function down()
    {
        Schema::table('customers_account', function (Blueprint $table) {
            $table->dropColumn(['github_id', 'avatar', 'github_nickname', 'token']);
        });
    }
};
