<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_factura extends Model
{
    use HasFactory;
    protected $table="tipo_factura";
    public $timestamps=false;
    protected $fillable = [
        'nom_tipo_factura',
    ];
}
