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
        Schema::create('pago', function (Blueprint $table) {
            $table->id("pk_pago")->autoIncrement();
            $table->unsignedBigInteger("fk_cliente");
            $table->unsignedBigInteger("fk_sucursal");
            $table->decimal("cantidad_pago", 10, 2);
            $table->decimal("cant_pago_mn", 10, 2);
            $table->decimal("cant_pago_dls", 10, 2);
            $table->unsignedBigInteger("fk_moneda");
            $table->unsignedBigInteger("fk_tasa");
            $table->unsignedBigInteger("fk_tipo_pago");
            $table->unsignedBigInteger("fk_forma_pago");
            $table->unsignedBigInteger("fk_proyecto_general");
            $table->date("fecha_pago")->nullable();
            $table->string("estatus", 10);

            $table->foreign("fk_cliente")
                ->references("pk_cliente")
                ->on("cliente");

            $table->foreign("fk_sucursal")
                ->references("pk_sucursal")
                ->on("sucursal");

            $table->foreign("fk_moneda")
                ->references("pk_moneda")
                ->on("moneda");

            $table->foreign("fk_tasa")
                ->references("pk_tasa")
                ->on("tasa");

            $table->foreign("fk_tipo_pago")
                ->references("pk_tipo_pago")
                ->on("tipo_pago");

            $table->foreign("fk_forma_pago")
                ->references("pk_forma_pago")
                ->on("forma_pago");

            $table->foreign("fk_proyecto_general")
                ->references("pk_proyecto_general")
                ->on("proyecto_general");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago');
    }
};
