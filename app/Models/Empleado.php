<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table="empleado";
    protected $primaryKey="pk_empleado";
    public $timestamps=false;
    protected $fillable = [
        'fk_datos_comunes',
        'curriculum',
        'fk_puesto_empleado',
        'fecha_alta',
        'fecha_ult_mod',
        'estatus'
    ];
    public function datos_comunes(){
        return $this->belongsTo(Datos_comunes::class, 'fk_datos_comunes', 'pk_datos_comunes');
    }
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class, 'fk_empleado');
    }
    public function agregarPuestoEmpleado(){
        return $this->belongsTo(Puesto_empleado::class);
    }
}
