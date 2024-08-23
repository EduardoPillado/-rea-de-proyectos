<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table="pago";
    protected $primaryKey="pk_pago";
    public $timestamps=false;
    protected $fillable = [
        'fk_cliente',
        'fk_sucursal',
        'cantidad_pago',
        'cant_pago_mn',
        'cant_pago_dls',
        'fk_moneda',
        'fk_tasa',
        'fk_tipo_pago',
        'fk_forma_pago',
        'fk_proyecto_general',
        'fecha_pago',
        'fecha_act_pago',
        'estatus'
    ];
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'fk_cliente');
    }
    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'fk_sucursal');
    }
    public function moneda(){
        return $this->belongsTo(Moneda::class, 'fk_moneda');
    }
    public function tasa(){
        return $this->belongsTo(Tasa::class, 'fk_tasa');
    }
    public function tipo_pago(){
        return $this->belongsTo(Tipo_pago::class, 'fk_tipo_pago');
    }
    public function forma_pago(){
        return $this->belongsTo(Forma_pago::class, 'fk_forma_pago');
    }
    public function proyecto_general(){
        return $this->belongsTo(Proyecto_general::class, 'fk_proyecto_general');
    }
}
