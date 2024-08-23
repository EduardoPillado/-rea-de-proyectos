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
        Schema::create('sucursal', function (Blueprint $table) {
            $table->id("pk_sucursal")->autoIncrement();
            $table->string("nom_sucursal", 75);
            $table->unsignedBigInteger("fk_ubicacion_sucursal");

            $table->foreign("fk_ubicacion_sucursal")
                ->references("pk_ubicacion")
                ->on("ubicacion");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursal');
    }
};
