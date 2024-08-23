<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto_empleado extends Model
{
    use HasFactory;
    protected $table="puesto_empleado";
    protected $primaryKey="pk_puesto_empleado";
    public $timestamps=false;
    protected $fillable = [
        'nom_puesto',
    ];
    public function empleado(){
        return $this->hasMany(Empleado::class);
    }
}
