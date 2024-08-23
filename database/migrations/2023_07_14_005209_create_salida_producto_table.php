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
        Schema::create('salida_producto', function (Blueprint $table) {
            $table->id("pk_salida_producto")->autoIncrement();
            $table->unsignedBigInteger("fk_salida");
            $table->unsignedBigInteger("fk_almacen_existencias");
            $table->integer('cant_unidades')->nullable();
            $table->decimal('importe_mn', 10, 2)->nullable();
            $table->decimal('importe_dls', 10, 2)->nullable();

            $table->foreign("fk_salida")
                ->references("pk_salida")
                ->on("salida");

            $table->foreign("fk_almacen_existencias")
                ->references("pk_almacen_existencias")
                ->on("almacen_existencias");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salida_producto');
    }
};
