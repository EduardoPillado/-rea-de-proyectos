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
        Schema::create('estado', function (Blueprint $table) {
            $table->id("pk_estado")->autoIncrement();
            $table->string("nom_estado", 65);
            $table->unsignedBigInteger("fk_pais_estado");

            $table->foreign("fk_pais_estado")
                ->references("pk_pais")
                ->on("pais");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado');
    }
};
