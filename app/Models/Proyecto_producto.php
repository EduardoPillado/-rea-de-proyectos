<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto_producto extends Model
{
    use HasFactory;
    protected $table="proyecto_producto";
    protected $primaryKey='pk_proyecto_producto';
    public $timestamps=false;
    protected $fillable = [
        'fk_proyecto_general',
        'fk_almacen_existencias',
        'cant_unidades',
        'descuento',
        'importe_mn',
        'importe_dls'
    ];
    public function proyecto_general(){
        return $this->belongsTo(Proyecto_general::class, 'fk_proyecto_general');
    }
}
