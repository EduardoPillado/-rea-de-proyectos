<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_salida extends Model
{
    use HasFactory;
    protected $table="tipo_salida";
    protected $primaryKey="pk_tipo_salida";
    public $timestamps=false;
    protected $fillable = [
        'nom_salida',
    ];
    public function salida(){
        return $this->hasMany(Salida::class);
    }
}
