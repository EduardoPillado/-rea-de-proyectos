<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo_producto extends Model
{
    use HasFactory;
    protected $table="grupo_producto";
    protected $primaryKey="pk_grupo_producto";
    public $timestamps=false;
    protected $fillable = [
        'nom_grupo',
    ];
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
