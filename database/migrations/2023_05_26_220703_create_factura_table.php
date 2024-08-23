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
        Schema::create('factura', function (Blueprint $table) {
            $table->id('pk_factura')->autoIncrement();
            $table->unsignedBigInteger('fk_cliente');
            $table->unsignedBigInteger('fk_uso_cfdi')->nullable();
            $table->unsignedBigInteger('fk_tipo_factura')->nullable();
            $table->unsignedBigInteger('fk_regimen_fiscal')->nullable();
            $table->unsignedBigInteger('fk_sucursal')->nullable();
            $table->unsignedBigInteger('fk_plaza')->nullable();
            $table->unsignedBigInteger('fk_pago')->nullable();
            $table->unsignedBigInteger('fk_proyecto_general')->nullable();
            $table->unsignedBigInteger('fk_moneda')->nullable();
            $table->integer('tipo_cambio')->nullable();
            $table->string('posterior_venta', 2)->nullable();
            $table->unsignedBigInteger('fk_metodo_pago')->nullable();
            $table->unsignedBigInteger('fk_forma_pago')->nullable();
            $table->string('condiciones_pago', 55)->nullable();
            $table->integer('total_factura')->nullable();

            $table->foreign('fk_cliente')
                ->references('pk_cliente')
                ->on('cliente');

            $table->foreign('fk_uso_cfdi')
                ->references('pk_uso_cfdi')
                ->on('uso_cfdi');

            $table->foreign('fk_tipo_factura')
                ->references('pk_tipo_factura')
                ->on('tipo_factura');

            $table->foreign('fk_regimen_fiscal')
                ->references('pk_regimen_fiscal')
                ->on('regimen_fiscal');

            $table->foreign('fk_sucursal')
                ->references('pk_sucursal')
                ->on('sucursal');

            $table->foreign('fk_plaza')
                ->references('pk_plaza')
                ->on('plaza');

            $table->foreign('fk_pago')
                ->references('pk_pago')
                ->on('pago');

            $table->foreign('fk_proyecto_general')
                ->references('pk_proyecto_general')
                ->on('proyecto_general');

            $table->foreign('fk_moneda')
                ->references('pk_moneda')
                ->on('moneda');

            $table->foreign('fk_metodo_pago')
                ->references('pk_metodo_pago')
                ->on('metodo_pago');
                
            $table->foreign('fk_forma_pago')
                ->references('pk_forma_pago')
                ->on('forma_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura');
    }
};
