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
        Schema::create('proyecto_producto', function (Blueprint $table) {
            $table->id('pk_proyecto_producto')->autoIncrement();
            $table->unsignedBigInteger("fk_proyecto_general")->nullable();
            $table->unsignedBigInteger("fk_almacen_existencias")->nullable();
            $table->integer('cant_unidades')->nullable();
            $table->decimal('descuento', 10, 2)->nullable();
            $table->decimal('importe_mn', 10, 2)->nullable();
            $table->decimal('importe_dls', 10, 2)->nullable();
            
            $table->foreign("fk_proyecto_general")
                ->references("pk_proyecto_general")
                ->on("proyecto_general");
            
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
        Schema::dropIfExists('proyecto_producto');
    }
};
