<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metodo_pago extends Model
{
    use HasFactory;
    protected $table="metodo_pago";
    protected $primaryKey='pk_metodo_pago';
    public $timestamps=false;
    protected $fillable = [
        'nom_metodo_pago',
    ];
    public function factura(){
        return $this->hasMany(Factura::class);
    }
}
