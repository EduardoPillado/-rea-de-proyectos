<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad_medida extends Model
{
    use HasFactory;
    protected $table="unidad_medida";
    protected $primaryKey="pk_unidad_medida";
    public $timestamps=false;
    protected $fillable = [
        'tipo_unidad',
    ];
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
