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
        Schema::create('proyecto_general', function (Blueprint $table) {
            $table->id("pk_proyecto_general")->autoIncrement();
            $table->string('nom_proyecto_general')->nullable();
            $table->unsignedBigInteger("fk_cliente");
            $table->unsignedBigInteger("fk_sucursal")->nullable();
            $table->unsignedBigInteger("fk_sistema_riego");
            $table->unsignedBigInteger("fk_cultivo");
            $table->date("fecha_inicio");
            $table->decimal("superficie", 10, 2);
            $table->integer("vigencia_dias");
            $table->string("predio", 75);
            $table->unsignedBigInteger("fk_categoria_proyecto")->nullable();
            $table->unsignedBigInteger("fk_etapa");
            $table->unsignedBigInteger("fk_cotizacion")->nullable();
            $table->string("nom_ubicacion_proyecto", 75);
            $table->text("imagen_ubicacion")->nullable();
            $table->text("plano_pdf")->nullable();
            $table->decimal("importe_total_mn", 10, 2)->nullable();
            $table->decimal("cantidad_restante_mn", 10, 2)->nullable();
            $table->decimal("importe_total_dls", 10, 2)->nullable();
            $table->decimal("cantidad_restante_dls", 10, 2)->nullable();
            $table->unsignedBigInteger("fk_empleado");
            $table->string("estatus", 10);

            $table->foreign("fk_cliente")
                ->references("pk_cliente")
                ->on("cliente");

            $table->foreign("fk_sucursal")
                ->references("pk_sucursal")
                ->on("sucursal");

            $table->foreign("fk_sistema_riego")
                ->references("pk_sistema_riego")
                ->on("sistema_riego");

            $table->foreign("fk_cultivo")
                ->references("pk_cultivo")
                ->on("cultivo");

            $table->foreign("fk_categoria_proyecto")
                ->references("pk_categoria_proyecto")
                ->on("categoria_proyecto");

            $table->foreign("fk_etapa")
                ->references("pk_etapa")
                ->on("etapa");

            $table->foreign("fk_cotizacion")
                ->references("pk_cotizacion")
                ->on("cotizacion");

            $table->foreign("fk_empleado")
                ->references("pk_empleado")
                ->on("empleado");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_general');
    }
};
