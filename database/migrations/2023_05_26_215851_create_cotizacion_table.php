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
        Schema::create('cotizacion', function (Blueprint $table) {
            $table->id('pk_cotizacion')->autoIncrement();
            $table->string('nom_archivo')->nullable();
            $table->text('ruta_archivo')->nullable();
            $table->unsignedBigInteger('fk_cliente');
            $table->unsignedBigInteger('fk_estado')->nullable();
            $table->unsignedBigInteger('fk_ubicacion')->nullable();
            $table->unsignedBigInteger('fk_sucursal')->nullable();
            $table->integer('area_regable');
            $table->date('fecha_cotizacion')->nullable();
            $table->integer('vigencia_cotizacion');
            $table->decimal("coti_importe_total_mn", 10, 2)->nullable();
            $table->decimal("coti_importe_total_dls", 10, 2)->nullable();
            $table->string('estatus', 10);

            $table->foreign('fk_cliente')
                ->references('pk_cliente')
                ->on('cliente');

            $table->foreign('fk_estado')
                ->references('pk_estado')
                ->on('estado');

            $table->foreign('fk_ubicacion')
                ->references('pk_ubicacion')
                ->on('ubicacion');

            $table->foreign('fk_sucursal')
                ->references('pk_sucursal')
                ->on('sucursal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacion');
    }
};
