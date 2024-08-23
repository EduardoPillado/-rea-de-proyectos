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
        Schema::create('municipio', function (Blueprint $table) {
            $table->id("pk_municipio")->autoIncrement();
            $table->string("nom_municipio", 65);
            $table->unsignedBigInteger("fk_estado_municipio");

            $table->foreign("fk_estado_municipio")
                ->references("pk_estado")
                ->on("estado");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipio');
    }
};
