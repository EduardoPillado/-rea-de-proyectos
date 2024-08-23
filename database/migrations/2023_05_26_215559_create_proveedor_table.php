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
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id("pk_proveedor")->autoIncrement();
            $table->string("razon_social", 100)->nullable();
            $table->string("extranjero", 2)->nullable();
            $table->string("multiafectable", 2)->nullable();
            $table->string("riego", 2)->nullable();
            $table->unsignedBigInteger("fk_datos_comunes");
            $table->unsignedBigInteger("fk_sucursal");
            $table->string("rfc", 45);
            $table->string("cuenta_contable_mn", 70)->nullable();
            $table->string("cuenta_contable_dls", 70)->nullable();
            $table->string("cuenta_complementaria", 70)->nullable();
            $table->string("cuenta_afectable", 70)->nullable();
            $table->unsignedBigInteger("fk_credito");
            $table->unsignedBigInteger("fk_tipo_proveedor");
            $table->unsignedBigInteger("fk_tipo_operacion");
            $table->date("fecha_alta")->nullable();
            $table->date("fecha_ult_mod")->nullable();
            $table->string("estatus", 10);

            $table->foreign("fk_datos_comunes")
                ->references("pk_datos_comunes")
                ->on("datos_comunes");

            $table->foreign("fk_sucursal")
                ->references("pk_sucursal")
                ->on("sucursal");

            $table->foreign("fk_credito")
                ->references("pk_credito")
                ->on("credito");

            $table->foreign("fk_tipo_proveedor")
                ->references("pk_tipo_proveedor")
                ->on("tipo_proveedor");

            $table->foreign("fk_tipo_operacion")
                ->references("pk_tipo_operacion")
                ->on("tipo_operacion");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedor');
    }
};
