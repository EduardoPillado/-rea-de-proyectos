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
        Schema::create('cotizacion_excel_cotizacion', function (Blueprint $table) {
            $table->id('pk_cotizacion_excel_cotizacion')->autoIncrement();
            $table->unsignedBigInteger('fk_cotizacion')->nullable();
            $table->unsignedBigInteger('fk_excel_cotizacion')->nullable();

            $table->foreign('fk_cotizacion')
                ->references('pk_cotizacion')
                ->on('cotizacion');

            $table->foreign('fk_excel_cotizacion')
                ->references('pk_excel_cotizacion')
                ->on('excel_cotizacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacion_excel_cotizacion');
    }
};
