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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id("pk_cliente")->autoIncrement();
            $table->string("razon_social", 100)->nullable();
            $table->unsignedBigInteger("fk_datos_comunes");
            $table->unsignedBigInteger('fk_sucursal');
            $table->string("rfc", 45);
            $table->unsignedBigInteger("fk_uso_cfdi")->nullable();
            $table->unsignedBigInteger("fk_regimen_fiscal");
            $table->text("constancia_situa_fiscal")->nullable();
            $table->string("cuenta_contable_mn", 70)->nullable();
            $table->string("cuenta_anticipo", 70)->nullable();
            $table->unsignedBigInteger("fk_grupo_cliente")->nullable();
            $table->unsignedBigInteger("fk_agente");
            $table->string("extranjero", 2)->nullable();
            $table->string("multisucursal", 2)->nullable();
            $table->string("cliente_agricultor", 2)->nullable();
            $table->string("cliente_iva_extra", 2)->nullable();
            $table->date("fecha_alta")->nullable();
            $table->date("fecha_ult_mod")->nullable();
            $table->string("estatus", 10);

            $table->foreign("fk_datos_comunes")
                ->references("pk_datos_comunes")
                ->on("datos_comunes");

            $table->foreign("fk_sucursal")
                ->references("pk_sucursal")
                ->on("sucursal");

            $table->foreign("fk_uso_cfdi")
                ->references("pk_uso_cfdi")
                ->on("uso_cfdi");
            
            $table->foreign("fk_regimen_fiscal")
                ->references("pk_regimen_fiscal")
                ->on("regimen_fiscal");

            $table->foreign("fk_grupo_cliente")
                ->references("pk_grupo_cliente")
                ->on("grupo_cliente");

            $table->foreign("fk_agente")
                ->references("pk_agente")
                ->on("agente");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
