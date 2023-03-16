<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('details_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_account')->unsigned()->nullable(false);
            $table->bigInteger('id_detail_type')->unsigned()->nullable(false);
            $table->date('fecha')->nullable(false);
            $table->float('monto', 8, 2);
            $table->string('comments', 100)->nullable();
            $table->foreign('id_account')->references('id')->on('accounts');
            $table->foreign('id_detail_type')->references('id')->on('details_accounts_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_accounts');
    }
};
