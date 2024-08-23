<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasa extends Model
{
    use HasFactory;
    protected $table="tasa";
    protected $primaryKey='pk_tasa';
    public $timestamps=false;
    protected $fillable = [
        'cant_tasa',
        'tipo_cambio'
    ];
    public function productos(){
        return $this->hasMany(Producto::class, 'fk_tasa');
    }
}
