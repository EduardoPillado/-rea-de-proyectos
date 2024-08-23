<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion_excel_cotizacion extends Model
{
    use HasFactory;
    protected $table="cotizacion_excel_cotizacion";
    protected $primaryKey="pk_cotizacion_excel_cotizacion";
    public $timestamps=false;
    protected $fillable = [
        'fk_cotizacion',
        'fk_excel_cotizacion'
    ];
    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'fk_cotizacion');
    }
}
