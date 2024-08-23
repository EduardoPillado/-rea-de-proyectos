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
        Schema::create('subgrupo_producto', function (Blueprint $table) {
            $table->id("pk_subgrupo_producto")->autoIncrement();
            $table->string("nom_subgrupo", 65);
            $table->unsignedBigInteger("fk_grupo_producto_subgrupo");

            $table->foreign("fk_grupo_producto_subgrupo")
                ->references("pk_grupo_producto")
                ->on("grupo_producto");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subgrupo_producto');
    }
};
