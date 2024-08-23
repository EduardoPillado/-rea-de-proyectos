<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uso_cfdi extends Model
{
    use HasFactory;
    protected $table="uso_cfdi";
    protected $primaryKey='pk_uso_cfdi';
    public $timestamps=false;
    protected $fillable = [
        'uso_cfdi',
    ];
    public function cliente(){
        return $this->hasMany(Cliente::class, 'fk_uso_cfdi', 'pk_uso_cfdi');
    }
}
