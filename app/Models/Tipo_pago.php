<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_pago extends Model
{
    use HasFactory;
    protected $table="tipo_pago";
    protected $primaryKey="pk_tipo_pago";
    public $timestamps=false;
    protected $fillable = [
        'nom_tipo_pago',
    ];
    public function pago(){
        return $this->hasMany(Pago::class, 'fk_tipo_pago');
    }
}
