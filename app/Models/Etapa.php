<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    use HasFactory;
    protected $table="etapa";
    protected $primaryKey='pk_etapa';
    public $timestamps=false;
    protected $fillable = [
        'nom_etapa',
    ];
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class, 'fk_etapa');
    }
}
