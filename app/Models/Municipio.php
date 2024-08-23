<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $table="municipio";
    protected $primaryKey='pk_municipio';
    public $timestamps=false;
    protected $fillable = [
        'nom_municipio',
        'fk_estado_municipio'
    ];
    public function cliente(){
        return $this->hasMany(Cliente::class);
    }
    public function datos_comunes(){
        return $this->hasMany(Datos_comunes::class, 'fk_municipio', 'pk_municipio');
    }
    public function estado(){
        return $this->belongsTo(Estado::class, 'fk_estado_municipio');
    }
    public function ubicacion(){
        return $this->hasMany(Ubicacion::class, 'fk_municipio_ubicacion', 'pk_municipio');
    }
    public function producto(){
        return $this->hasMany(Producto::class);
    }
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class);
    }
}
