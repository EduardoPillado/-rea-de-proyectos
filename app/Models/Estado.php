<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $table="estado";
    protected $primaryKey='pk_estado';
    public $timestamps=false;
    protected $fillable = [
        'nom_estado',
        'fk_pais_estado'
    ];
    public function cliente(){
        return $this->hasMany(Cliente::class);
    }
    public function datos_comunes(){
        return $this->hasMany(Datos_comunes::class, 'fk_estado', 'pk_estado');
    }
    public function pais(){
        return $this->belongsTo(Pais::class, 'fk_pais_estado', 'pk_pais');
    }
    public function municipio(){
        return $this->hasMany(Municipio::class, 'fk_estado_municipio', 'pk_estado');
    }
    public function producto(){
        return $this->hasMany(Producto::class);
    }
    public function cotizacion(){
        return $this->hasMany(Cotizacion::class, 'fk_estado');
    }
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class);
    }
}
