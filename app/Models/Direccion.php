<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    protected $table="direccion";
    protected $primaryKey='pk_direccion';
    public $timestamps=false;
    protected $fillable = [
        'calle',
        'numero',
        'colonia',
        'cp'
    ];
    public function datos_comunes(){
        return $this->hasOne(Datos_comunes::class, 'fk_direccion', 'pk_direccion');
    }
}
