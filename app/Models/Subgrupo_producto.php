<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgrupo_producto extends Model
{
    use HasFactory;
    protected $table="subgrupo_producto";
    protected $primaryKey="pk_subgrupo_producto";
    public $timestamps=false;
    protected $fillable = [
        'nom_subgrupo',
        'fk_grupo_producto_subgrupo'
    ];
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
