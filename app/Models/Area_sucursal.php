<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area_sucursal extends Model
{
    use HasFactory;
    protected $table="area_sucursal";
    protected $primaryKey="pk_area_sucursal";
    public $timestamps=false;
    protected $fillable = [
        'nom_area',
    ];
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
