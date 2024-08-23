<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regimen_fiscal extends Model
{
    use HasFactory;
    protected $table="regimen_fiscal";
    protected $primaryKey='pk_regimen_fiscal';
    public $timestamps=false;
    protected $fillable = [
        'regimen_fiscal',
    ];
    public function cliente(){
        return $this->hasMany(Cliente::class, 'fk_regimen_fiscal', 'pk_regimen_fiscal');
    }
}
