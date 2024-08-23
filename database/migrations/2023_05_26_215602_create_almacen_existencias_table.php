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
        Schema::create('almacen_existencias', function (Blueprint $table) {
            $table->id('pk_almacen_existencias')->autoIncrement();
            $table->unsignedBigInteger('fk_producto')->nullable();
            $table->integer('cant_existencias')->nullable();
            $table->date('fecha_act_existencias')->nullable();

            $table->foreign('fk_producto')
                ->references('pk_producto')
                ->on('producto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacen_existencias');
    }
};
