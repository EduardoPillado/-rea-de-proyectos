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
        Schema::create('producto', function (Blueprint $table) {
            $table->id("pk_producto")->autoIncrement();
            $table->string("nom_producto", 80);
            $table->text("descrip")->nullable();
            $table->text("imagen_producto")->nullable();
            $table->unsignedBigInteger("fk_sucursal");
            $table->unsignedBigInteger("fk_area_sucursal");
            $table->unsignedBigInteger("fk_division");
            $table->unsignedBigInteger("fk_grupo_producto");
            $table->unsignedBigInteger("fk_subgrupo_producto");
            $table->unsignedBigInteger("fk_unidad_medida");
            $table->unsignedBigInteger("fk_clave_prod_serv_sat");
            $table->unsignedBigInteger('fk_proveedor')->nullable();
            $table->unsignedBigInteger('fk_moneda')->nullable();
            $table->unsignedBigInteger('fk_tasa')->nullable();
            $table->decimal("cantidad_unitaria", 10, 2)->nullable();
            $table->decimal("precio_unitario_mn", 10, 2)->nullable();
            $table->decimal('precio_unitario_dls', 10, 2)->nullable();
            $table->decimal("cantidad_proyecto", 10, 2)->nullable();
            $table->decimal("precio_proyecto_mn", 10, 2)->nullable();
            $table->decimal("precio_proyecto_dls", 10, 2)->nullable();
            $table->decimal("cantidad_especial", 10, 2)->nullable();
            $table->decimal("precio_especial_mn", 10, 2)->nullable();
            $table->decimal("precio_especial_dls", 10, 2)->nullable();
            $table->decimal("cantidad_promedio", 10, 2)->nullable();
            $table->decimal("costo_promedio_mn", 10, 2)->nullable();
            $table->decimal("costo_promedio_dls", 10, 2)->nullable();
            $table->decimal("ultima_cantidad", 10, 2)->nullable();
            $table->decimal("ultimo_costo_mn", 10, 2)->nullable();
            $table->decimal("ultimo_costo_dls", 10, 2)->nullable();
            $table->integer("margen_utilidad_porcentaje")->nullable();
            $table->unsignedBigInteger("fk_iva")->nullable();
            $table->date("fecha_ultima_mod")->nullable();
            $table->string("estatus", 10);

            $table->foreign("fk_sucursal")
                ->references("pk_sucursal")
                ->on("sucursal");

            $table->foreign("fk_area_sucursal")
                ->references("pk_area_sucursal")
                ->on("area_sucursal");

            $table->foreign("fk_division")
                ->references("pk_division")
                ->on("division");

            $table->foreign("fk_grupo_producto")
                ->references("pk_grupo_producto")
                ->on("grupo_producto");

            $table->foreign("fk_subgrupo_producto")
                ->references("pk_subgrupo_producto")
                ->on("subgrupo_producto");

            $table->foreign("fk_unidad_medida")
                ->references("pk_unidad_medida")
                ->on("unidad_medida");

            $table->foreign("fk_clave_prod_serv_sat")
                ->references("pk_clave_prod_serv_sat")
                ->on("clave_prod_serv_sat");

            $table->foreign("fk_proveedor")
                ->references("pk_proveedor")
                ->on("proveedor");

            $table->foreign("fk_moneda")
                ->references("pk_moneda")
                ->on("moneda");

            $table->foreign('fk_tasa')
                ->references('pk_tasa')
                ->on('tasa');

            $table->foreign("fk_iva")
                ->references("pk_iva")
                ->on("iva");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
