<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    protected $table="ubicacion";
    protected $primaryKey='pk_ubicacion';
    public $timestamps=false;
    protected $fillable = [
        'nom_ubicacion',
        'fk_municipio_ubicacion'
    ];
    public function cliente(){
        return $this->hasMany(Cliente::class);
    }
    public function datos_comunes(){
        return $this->hasMany(Datos_comunes::class, 'fk_ubicacion', 'pk_ubicacion');
    }
    public function municipio(){
        return $this->belongsTo(Municipio::class, 'fk_municipio_ubicacion', 'pk_municipio');
    }
    public function sucursal(){
        return $this->hasMany(Sucursal::class, 'fk_ubicacion_sucursal', 'pk_ubicacion');
    }
    public function producto(){
        return $this->hasMany(Producto::class);
    }
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class);
    }
    public function cotizacion(){
        return $this->hasMany(Cotizacion::class, 'fk_ubicacion');
    }
}
