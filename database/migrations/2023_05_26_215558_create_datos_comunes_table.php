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
        Schema::create('datos_comunes', function (Blueprint $table) {
            $table->id("pk_datos_comunes")->autoIncrement();
            $table->string("nombres", 75)->nullable();
            $table->string("a_paterno", 45)->nullable();
            $table->string("a_materno", 45)->nullable();
            $table->unsignedBigInteger("fk_direccion");
            $table->unsignedBigInteger("fk_pais")->nullable();
            $table->unsignedBigInteger("fk_estado")->nullable();
            $table->unsignedBigInteger("fk_municipio")->nullable();
            $table->unsignedBigInteger("fk_ubicacion")->nullable();
            $table->unsignedBigInteger("fk_nacionalidad")->nullable();
            $table->text("correo")->nullable();
            $table->string("telefono", 25)->nullable();
            $table->string("curp", 20)->nullable();

            $table->foreign("fk_direccion")
                ->references("pk_direccion")
                ->on("direccion");

            $table->foreign("fk_pais")
                ->references("pk_pais")
                ->on("pais");

            $table->foreign("fk_estado")
                ->references("pk_estado")
                ->on("estado");

            $table->foreign("fk_municipio")
                ->references("pk_municipio")
                ->on("municipio");

            $table->foreign("fk_ubicacion")
                ->references("pk_ubicacion")
                ->on("ubicacion");

            $table->foreign("fk_nacionalidad")
                ->references("pk_nacionalidad")
                ->on("nacionalidad");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_comunes');
    }
};
