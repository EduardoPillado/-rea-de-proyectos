<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excel_cotizacion extends Model
{
    use HasFactory;
    protected $table="excel_cotizacion";
    protected $primaryKey="pk_excel_cotizacion";
    public $timestamps=false;
    protected $fillable = [
        'concepto',
        'coti_unidad',
        'coti_cant_unidades',
        'coti_precio_unitario_mn',
        'coti_importe_mn',
        'coti_precio_unitario_dls',
        'coti_importe_dls',
    ];
    public function cotizaciones(){
        return $this->belongsToMany(Cotizacion::class, 'cotizacion_excel_cotizacion', 'fk_excel_cotizacion', 'fk_cotizacion');
    }
}
