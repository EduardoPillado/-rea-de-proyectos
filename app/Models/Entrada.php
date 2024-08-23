<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;
    protected $table="entrada";
    protected $primaryKey="pk_entrada";
    public $timestamps=false;
    protected $fillable = [
        'descripcion_entrada',
        'comentario_entrada',
        'fk_tipo_entrada',
        'fk_sucursal',
        'importe_total_mn',
        'importe_total_dls',
        'fk_iva',
        'fecha_entrada',
        'fecha_act_entrada',
        'estatus'
    ];
    protected $dates = [
        'fecha_entrada',
        'fecha_act_entrada'
    ];
    public function agregarTipoEntrada(){
        return $this->belongsTo(Tipo_entrada::class);
    }
    public function agregarSucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function agregarIva(){
        return $this->belongsTO(Iva::class);
    }
    public function productos(){
        return $this->belongsToMany(Producto::class, 'entrada_producto', 'fk_entrada', 'fk_producto')
            ->withPivot('cant_unidades');
    }
    public function entrada_producto(){
        return $this->hasMany(Entrada_producto::class, 'fk_entrada');
    }
}
