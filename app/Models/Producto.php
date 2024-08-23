<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table="producto";
    protected $primaryKey='pk_producto';
    public $timestamps=false;
    protected $fillable = [
        'nom_producto',
        'descrip',
        'imagen_producto',
        'fk_sucursal',
        'fk_area_sucursal',
        'fk_division',
        'fk_grupo_producto',
        'fk_subgrupo_producto',
        'fk_unidad_medida',
        'fk_clave_prod_serv_sat',
        'fk_proveedor',
        'fk_moneda',
        'fk_tasa',
        'cantidad_unitaria',
        'precio_unitario_mn',
        'precio_unitario_dls',
        'cantidad_proyecto',
        'precio_proyecto_mn',
        'precio_proyecto_dls',
        'cantidad_especial',
        'precio_especial_mn',
        'precio_especial_dls',
        'cantidad_promedio',
        'costo_promedio_mn',
        'costo_promedio_dls',
        'ultima_cantidad',
        'ultimo_costo_mn',
        'ultimo_costo_dls',
        'margen_utilidad_porcentaje',
        'fk_iva',
        'fecha_ultima_mod',
        'estatus',
    ];
    public function agregarPais(){
        return $this->belongsTo(Pais::class);
    }
    public function agregarEstado(){
        return $this->belongsTo(Estado::class);
    }
    public function agregarMunicipio(){
        return $this->belongsTo(Municipio::class);
    }
    public function agregarUbicacion(){
        return $this->belongsTo(Ubicacion::class);
    }
    public function agregarSucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function agregarAreaSucursal(){
        return $this->belongsTo(Area_sucursal::class);
    }
    public function agregarDivision(){
        return $this->belongsTo(Division::class);
    }
    public function agregarGrupoProducto(){
        return $this->belongsTo(Grupo_producto::class);
    }
    public function agregarSubgrupoProducto(){
        return $this->belongsTo(Subgrupo_producto::class);
    }
    public function agregarUnidadMedida(){
        return $this->belongsTo(Unidad_medida::class);
    }
    public function agregarClaveProdServSat(){
        return $this->belongsTo(Clave_prod_serv_sat::class);
    }
    public function agregarMoneda(){
        return $this->belongsTo(Moneda::class);
    }
    public function agregarTasa(){
        return $this->belongsTo(Tasa::class);
    }
    public function agregarIva(){
        return $this->belongsTo(Iva::class);
    }
    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'fk_sucursal');
    }
    public function area_sucursal(){
        return $this->belongsTo(Area_sucursal::class, 'fk_area_sucursal');
    }
    public function division(){
        return $this->belongsTo(Division::class, 'fk_division');
    }
    public function grupo_producto(){
        return $this->belongsTo(Grupo_producto::class, 'fk_grupo_producto');
    }
    public function subgrupo_producto(){
        return $this->belongsTo(Subgrupo_producto::class, 'fk_subgrupo_producto');
    }
    public function unidad_medida(){
        return $this->belongsTo(Unidad_medida::class, 'fk_unidad_medida');
    }
    public function clave_prod_serv_sat(){
        return $this->belongsTo(Clave_prod_serv_sat::class, 'fk_clave_prod_serv_sat');
    }
    public function moneda(){
        return $this->belongsTo(Moneda::class, 'fk_moneda');
    }
    public function tasa(){
        return $this->belongsTo(Tasa::class, 'fk_tasa');
    }
    public function iva(){
        return $this->belongsTo(Iva::class, 'fk_iva');
    }
    public function entradas(){
        return $this->belongsToMany(Entrada::class, 'entrada_producto', 'fk_producto', 'fk_entrada')
            ->withPivot('cant_unidades');
    }
    public function pago(){
        return $this->hasMany(Pago::class);
    }
    public function almacen_existencias() {
        return $this->hasOne(Almacen_existencias::class, 'fk_producto', 'pk_producto');
    }    
    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'fk_proveedor');
    }
}
