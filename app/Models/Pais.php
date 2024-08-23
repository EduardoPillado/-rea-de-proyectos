<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    protected $table="pais";
    protected $primaryKey='pk_pais';
    public $timestamps=false;
    protected $fillable = [
        'nom_pais',
    ];
    public function cliente(){
        return $this->hasMany(Cliente::class);
    }
    public function datos_comunes(){
        return $this->hasMany(Datos_comunes::class, 'fk_pais', 'pk_pais');
    }
    public function estado(){
        return $this->hasMany(Estado::class, 'fk_pais_estado', 'pk_pais');
    }
    public function producto(){
        return $this->hasMany(Producto::class);
    }
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class);
    }
}
