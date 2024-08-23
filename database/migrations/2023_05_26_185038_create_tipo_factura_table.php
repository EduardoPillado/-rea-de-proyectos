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
        Schema::create('tipo_factura', function (Blueprint $table) {
            $table->id("pk_tipo_factura")->autoIncrement();
            $table->string("nom_tipo_factura", 45);
            $table->string("estatus", 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_factura');
    }
};
