<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datos_comunes extends Model
{
    use HasFactory;
    protected $table="datos_comunes";
    protected $primaryKey='pk_datos_comunes';
    public $timestamps=false;
    protected $fillable = [
        'nombres',
        'a_paterno',
        'a_materno',
        'fk_direccion',
        'fk_pais',
        'fk_estado',
        'fk_municipio',
        'fk_ubicacion',
        'fk_nacionalidad',
        'correo',
        'telefono',
        'curp'
    ];
    public function cliente(){
        return $this->hasOne(Cliente::class, 'fk_datos_comunes', 'pk_datos_comunes');
    }
    public function empleado(){
        return $this->hasOne(Empleado::class, 'fk_datos_comunes', 'pk_datos_comunes');
    }
    public function proveedor(){
        return $this->hasOne(Proveedor::class, 'fk_datos_comunes', 'pk_datos_comunes');
    }
    public function direccion(){
        return $this->belongsTo(Direccion::class, 'fk_direccion', 'pk_direccion');
    }
    public function nacionalidad(){
        return $this->belongsTo(Nacionalidad::class, 'fk_nacionalidad', 'pk_nacionalidad');
    }
    public function pais(){
        return $this->belongsTo(Pais::class, 'fk_pais', 'pk_pais');
    }
    public function estado(){
        return $this->belongsTo(Estado::class, 'fk_estado', 'pk_estado');
    }
    public function municipio(){
        return $this->belongsTo(Municipio::class, 'fk_municipio', 'pk_municipio');
    }
    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class, 'fk_ubicacion', 'pk_ubicacion');
    }
}
