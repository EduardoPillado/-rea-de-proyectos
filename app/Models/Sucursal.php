<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $table="sucursal";
    protected $primaryKey='pk_sucursal';
    public $timestamps=false;
    protected $fillable = [
        'nom_sucursal',
        'fk_ubicacion_sucursal'
    ];
    public function cliente(){
        return $this->hasMany(Cliente::class, 'fk_sucursal', 'pk_sucursal');
    }
    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class, 'fk_ubicacion_sucursal', 'pk_ubicacion');
    }
    public function producto(){
        return $this->hasMany(Producto::class);
    }
    public function cotizacion(){
        return $this->hasMany(Cotizacion::class, 'fk_sucursal');
    }
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class, 'fk_sucursal');
    }
    public function pago(){
        return $this->hasMany(Pago::class, 'fk_sucursal');
    }
    public function entrada(){
        return $this->hasMany(Entrada::class);
    }
    public function salida(){
        return $this->hasMany(Salida::class);
    }
}
