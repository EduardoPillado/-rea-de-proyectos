<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_entrada extends Model
{
    use HasFactory;
    protected $table="tipo_entrada";
    protected $primaryKey="pk_tipo_entrada";
    public $timestamps=false;
    protected $fillable = [
        'nom_entrada',
    ];
    public function entrada(){
        return $this->hasMany(Entrada::class);
    }
}
