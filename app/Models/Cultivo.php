<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cultivo extends Model
{
    use HasFactory;
    protected $table="cultivo";
    protected $primaryKey="pk_cultivo";
    public $timestamps=false;
    protected $fillable = [
        'nom_cultivo',
    ];
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class, 'fk_cultivo');
    }
}
