<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{
    use HasFactory;
    protected $table="iva";
    protected $primaryKey="pk_iva";
    public $timestamps=false;
    protected $fillable = [
        'cant_iva',
    ];
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
