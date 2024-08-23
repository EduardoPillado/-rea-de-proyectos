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
        Schema::create('entrada', function (Blueprint $table) {
            $table->id('pk_entrada')->autoIncrement();
            $table->text('descripcion_entrada');
            $table->text('comentario_entrada')->nullable();
            $table->unsignedBigInteger('fk_tipo_entrada');
            $table->unsignedBigInteger('fk_sucursal')->nullable();
            $table->decimal('importe_total_mn', 10, 2)->nullable();
            $table->decimal('importe_total_dls', 10, 2)->nullable();
            $table->unsignedBigInteger('fk_iva')->nullable();
            $table->date('fecha_entrada')->nullable();
            $table->string("estatus", 10);

            $table->foreign('fk_tipo_entrada')
                ->references('pk_tipo_entrada')
                ->on('tipo_entrada');

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
        Schema::dropIfExists('entrada');
    }
};
