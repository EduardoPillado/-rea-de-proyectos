<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistema_riego extends Model
{
    use HasFactory;
    protected $table="sistema_riego";
    protected $primaryKey="pk_sistema_riego";
    public $timestamps=false;
    protected $fillable = [
        'nom_sistema',
    ];
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class, 'fk_sistema_riego');
    }
}
