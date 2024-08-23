<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo_cliente extends Model
{
    use HasFactory;
    protected $table="grupo_cliente";
    protected $primaryKey='pk_grupo_cliente';
    public $timestamps=false;
    protected $fillable = [
        'nom_grupo',
    ];
    public function cliente(){
        return $this->hasMany(Cliente::class, 'fk_grupo_cliente', 'pk_grupo_cliente');
    }
}
