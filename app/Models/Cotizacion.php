<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $table="cotizacion";
    protected $primaryKey="pk_cotizacion";
    public $timestamps=false;
    protected $fillable = [
        'nom_archivo',
        'ruta_archivo',
        'fk_cliente',
        'fk_estado',
        'fk_ubicacion',
        'fk_sucursal',
        'area_regable',
        'fecha_cotizacion',
        'vigencia_cotizacion',
        'coti_importe_total_mn',
        'coti_importe_total_dls',
        'estatus'
    ];
    public function excelCotizaciones(){
        return $this->belongsToMany(Excel_cotizacion::class, 'cotizacion_excel_cotizacion', 'fk_cotizacion', 'fk_excel_cotizacion');
    }
    public function cotizacionExcelCotizacion(){
        return $this->hasMany(Excel_cotizacion::class, 'fk_cotizacion');
    }
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class, 'fk_cotizacion');
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'fk_cliente');
    }
    public function agregarEstado(){
        return $this->belongsTo(Estado::class);
    }
    public function estado(){
        return $this->belongsTo(Estado::class, 'fk_estado');
    }
    public function agregarUbicacion(){
        return $this->belongsTo(Ubicacion::class);
    }
    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class, 'fk_ubicacion');
    }
    public function agregarSucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'fk_sucursal');
    }
}
