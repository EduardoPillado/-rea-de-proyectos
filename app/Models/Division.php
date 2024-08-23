<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $table="division";
    protected $primaryKey="pk_division";
    public $timestamps=false;
    protected $fillable = [
        'nom_division',
    ];
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
