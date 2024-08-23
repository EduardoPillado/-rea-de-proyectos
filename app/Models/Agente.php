<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    use HasFactory;
    protected $table="agente";
    protected $primaryKey='pk_agente';
    public $timestamps=false;
    protected $fillable = [
        'nom_agente',
    ];
    public function cliente(){
        return $this->hasMany(Cliente::class, 'fk_agente', 'pk_agente');
    }
}
