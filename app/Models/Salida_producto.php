<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida_producto extends Model
{
    use HasFactory;
    protected $table="salida_producto";
    protected $primaryKey='pk_salida_producto';
    public $timestamps=false;
    protected $fillable = [
        'fk_salida',
        'fk_almacen_existencias',
        'cant_unidades',
        'importe_mn',
        'importe_dls'
    ];
    public function salida(){
        return $this->belongsTo(Salida::class, 'fk_salida');
    }
}
