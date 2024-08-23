<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use HasFactory;
    protected $table="moneda";
    protected $primaryKey="pk_moneda";
    public $timestamps=false;
    protected $fillable = [
        'nom_moneda',
    ];
    public function productos(){
        return $this->hasMany(Producto::class, 'fk_moneda');
    }
    public function pago(){
        return $this->hasMany(Pago::class, 'fk_moneda');
    }
}
