<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_producto extends Model
{
    use HasFactory;
    protected $table="entrada_producto";
    protected $primaryKey='pk_entrada_producto';
    public $timestamps=false;
    protected $fillable = [
        'fk_entrada',
        'fk_producto',
        'cant_unidades',
        'importe_mn',
        'importe_dls'
    ];
    public function entrada(){
        return $this->belongsTo(Entrada::class, 'fk_entrada');
    }
}
