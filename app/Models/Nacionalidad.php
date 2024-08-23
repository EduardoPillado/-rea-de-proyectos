<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    use HasFactory;
    protected $table="nacionalidad";
    protected $primaryKey='pk_nacionalidad';
    public $timestamps=false;
    protected $fillable = [
        'nom_nacionalidad',
    ];
    public function cliente(){
        return $this->hasMany(Cliente::class);
    }
    public function datos_comunes(){
        return $this->hasMany(Datos_comunes::class, 'fk_nacionalidad', 'pk_nacionalidad');
    }
}
