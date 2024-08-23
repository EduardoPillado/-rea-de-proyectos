<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_proveedor extends Model
{
    use HasFactory;
    protected $table="tipo_proveedor";
    protected $primaryKey="pk_tipo_proveedor";
    public $timestamps=false;
    protected $fillable = [
        'nom_tipo_proveedor',
    ];
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
