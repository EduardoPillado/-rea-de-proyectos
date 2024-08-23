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
        Schema::create('salida', function (Blueprint $table) {
            $table->id('pk_salida')->autoIncrement();
            $table->text('descripcion_salida');
            $table->text('comentario_salida')->nullable();
            $table->unsignedBigInteger('fk_tipo_salida');
            $table->unsignedBigInteger('fk_sucursal')->nullable();
            $table->decimal('importe_total_mn', 10, 2)->nullable();
            $table->decimal('importe_total_dls', 10, 2)->nullable();
            $table->unsignedBigInteger('fk_iva')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->string("estatus", 10);

            $table->foreign('fk_tipo_salida')
                ->references('pk_tipo_salida')
                ->on('tipo_salida');

            $table->foreign('fk_sucursal')
                ->references('pk_sucursal')
                ->on('sucursal');

            $table->foreign('fk_iva')
                ->references('pk_iva')
                ->on('iva');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salida');
    }
};
