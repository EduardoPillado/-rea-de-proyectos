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
        Schema::create('clave_prod_serv_sat', function (Blueprint $table) {
            $table->id("pk_clave_prod_serv_sat")->autoIncrement();
            $table->string("clave_serv", 85);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clave_prod_serv_sat');
    }
};
