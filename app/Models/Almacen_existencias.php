<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen_existencias extends Model
{
    use HasFactory;
    protected $table="almacen_existencias";
    protected $primaryKey='pk_almacen_existencias';
    public $timestamps = false;
    protected $fillable = [
        'fk_producto',
        'cant_existencias',
        'fecha_act_existencias'
    ];
    protected $dates = [
        'fecha_act_existencias'
    ];
    public function producto(){
        return $this->belongsTo(Producto::class, 'fk_producto', 'pk_producto');
    }
    public function salidas(){
        return $this->belongsToMany(Salida::class, 'salida_producto', 'fk_almacen_existencias', 'fk_salida')
            ->withPivot('cant_unidades');
    }
    public function proyectos(){
        return $this->belongsToMany(Proyecto_general::class, 'proyecto_producto', 'fk_almacen_existencias', 'fk_proyecto_general')
            ->withPivot('cant_unidades', 'descuento');
    }
}
