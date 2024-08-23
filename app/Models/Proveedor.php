<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table="proveedor";
    protected $primaryKey="pk_proveedor";
    public $timestamps=false;
    protected $fillable = [
        'razon_social',
        'extranjero',
        'multiafectable',
        'riego',
        'fk_datos_comunes',
        'fk_sucursal',
        'rfc',
        'cuenta_contable_mn',
        'cuenta_contable_dls',
        'cuenta_complementaria',
        'cuenta_afectable',
        'fk_credito',
        'fk_tipo_proveedor',
        'fk_tipo_operacion',
        'fecha_alta',
        'fecha_ult_mod',
        'estatus'
    ];
    public function datos_comunes(){
        return $this->belongsTo(Datos_comunes::class, 'fk_datos_comunes', 'pk_datos_comunes');
    }
    public function credito(){
        return $this->belongsTo(Credito::class, 'fk_credito', 'pk_credito');
    }
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
    public function agregarNacionalidad(){
        return $this->belongsTo(Nacionalidad::class);
    }
    public function agregarTipoProveedor(){
        return $this->belongsTo(Tipo_proveedor::class);
    }
    public function agregarTipoOperacion(){
        return $this->belongsTo(Tipo_operacion::class);
    }
    public function producto(){
        return $this->hasMany(Producto::class, 'fk_proveedor');
    }
}
