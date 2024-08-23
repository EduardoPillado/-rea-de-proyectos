<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;
    protected $table="salida";
    protected $primaryKey="pk_salida";
    public $timestamps=false;
    protected $fillable = [
        'descripcion_salida',
        'comentario_salida',
        'fk_tipo_salida',
        'fk_sucursal',
        'importe_total_mn',
        'importe_total_dls',
        'fk_iva',
        'fecha_salida',
        'fecha_act_salida',
        'estatus'
    ];
    protected $dates = [
        'fecha_salida',
        'fecha_act_salida'
    ];
    public function agregarTipoSalida(){
        return $this->belongsTo(Tipo_salida::class);
    }
    public function agregarSucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function agregarIva(){
        return $this->belongsTo(Proyecto_general::class);
    }
    public function productos(){
        return $this->belongsToMany(Producto::class, 'salida_producto', 'fk_salida', 'fk_almacen_existencias')
            ->withPivot('cant_unidades');
    }
    public function salida_producto(){
        return $this->hasMany(Salida_producto::class, 'fk_salida');
    }
}
