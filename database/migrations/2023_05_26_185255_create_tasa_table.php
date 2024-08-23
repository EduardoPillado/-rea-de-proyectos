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
        Schema::create('tasa', function (Blueprint $table) {
            $table->id('pk_tasa')->autoIncrement();
            $table->decimal('cant_tasa', 15, 4);
            $table->string('tipo_cambio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasa');
    }
};
