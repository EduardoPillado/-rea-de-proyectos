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
        Schema::create('excel_cotizacion', function (Blueprint $table) {
            $table->id('pk_excel_cotizacion')->autoIncrement();
            $table->string("concepto")->nullable();
            $table->string("coti_unidad")->nullable();
            $table->integer("coti_cant_unidades")->nullable();
            $table->decimal("coti_precio_unitario_mn", 10, 2)->nullable();
            $table->decimal("coti_importe_mn", 10, 2)->nullable();
            $table->decimal("coti_precio_unitario_dls", 10, 2)->nullable();
            $table->decimal("coti_importe_dls", 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excel_cotizacion');
    }
};
