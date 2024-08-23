<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria_proyecto extends Model
{
    use HasFactory;
    protected $table="categoria_proyecto";
    protected $primaryKey="pk_categoria_proyecto";
    public $timestamps=false;
    protected $fillable = [
        'nom_cat_proy',
    ];
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class, 'fk_categoria_proyecto');
    }
}
