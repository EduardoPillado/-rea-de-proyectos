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
        Schema::create('entrada_producto', function (Blueprint $table) {
            $table->id("pk_entrada_producto")->autoIncrement();
            $table->unsignedBigInteger("fk_entrada");
            $table->unsignedBigInteger("fk_producto");
            $table->integer('cant_unidades')->nullable();
            $table->decimal('importe_mn', 10, 2)->nullable();
            $table->decimal('importe_dls', 10, 2)->nullable();

            $table->foreign("fk_entrada")
                ->references("pk_entrada")
                ->on("entrada");

            $table->foreign("fk_producto")
                ->references("pk_producto")
                ->on("producto");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_producto');
    }
};
