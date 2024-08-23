<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forma_pago extends Model
{
    use HasFactory;
    protected $table="forma_pago";
    protected $primaryKey="pk_forma_pago";
    public $timestamps=false;
    protected $fillable = [
        'nom_forma_pago',
    ];
    public function pago(){
        return $this->hasMany(Pago::class, 'fk_forma_pago');
    }
}
