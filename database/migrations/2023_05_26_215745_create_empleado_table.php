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
        Schema::create('empleado', function (Blueprint $table) {
            $table->id("pk_empleado")->autoIncrement();
            $table->unsignedBigInteger("fk_datos_comunes");
            $table->text("curriculum")->nullable();
            $table->unsignedBigInteger("fk_puesto_empleado")->nullable();
            $table->date("fecha_alta")->nullable();
            $table->date("fecha_ult_mod")->nullable();
            $table->string("estatus", 10);

            $table->foreign("fk_datos_comunes")
                ->references("pk_datos_comunes")
                ->on("datos_comunes");

            $table->foreign("fk_puesto_empleado")
                ->references("pk_puesto_empleado")
                ->on("puesto_empleado");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
