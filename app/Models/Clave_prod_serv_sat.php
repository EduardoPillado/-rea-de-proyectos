<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clave_prod_serv_sat extends Model
{
    use HasFactory;
    protected $table="clave_prod_serv_sat";
    protected $primaryKey="pk_clave_prod_serv_sat";
    public $timestamps=false;
    protected $fillable = [
        'clave_serv',
    ];
    public function producto(){
        return $this->hasMany(Producto::class);
    }
}
