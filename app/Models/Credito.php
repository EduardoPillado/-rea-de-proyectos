<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;
    protected $table="credito";
    protected $primaryKey="pk_credito";
    public $timestamps=false;
    protected $fillable = [
        'dias_credito',
        'tiempo_surtido'
    ];
    public function proveedor(){
        return $this->hasOne(Proveedor::class, 'fk_credito', 'pk_credito');
    }
}
