<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_operacion extends Model
{
    use HasFactory;
    protected $table="tipo_operacion";
    protected $primaryKey="pk_tipo_operacion";
    public $timestamps=false;
    protected $fillable = [
        'nom_tipo_operacion',
    ];
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
