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
        Schema::create('ubicacion', function (Blueprint $table) {
            $table->id("pk_ubicacion")->autoIncrement();
            $table->string("nom_ubicacion", 75)->nullable();
            $table->unsignedBigInteger("fk_municipio_ubicacion");

            $table->foreign("fk_municipio_ubicacion")
                ->references("pk_municipio")
                ->on("municipio");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacion');
    }
};
