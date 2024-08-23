<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table="cliente";
    protected $primaryKey='pk_cliente';
    protected $fillable = [
        'razon_social', 
        'fk_datos_comunes', 
        'fk_sucursal', 
        'rfc', 
        'fk_uso_cfdi', 
        'fk_regimen_fiscal', 
        'constancia_situa_fiscal', 
        'cuenta_contable_mn', 
        'cuenta_anticipo', 
        'fk_grupo_cliente', 
        'fk_agente', 
        'extranjero', 
        'multisucursal', 
        'cliente_agricultor', 
        'cliente_iva_extra', 
        'fecha_alta', 
        'fecha_ult_mod', 
        'estatus'
    ];
    public $timestamps=false;
    public function datos_comunes(){
        return $this->belongsTo(Datos_comunes::class, 'fk_datos_comunes', 'pk_datos_comunes');
    }
    public function agregarPais(){
        return $this->belongsTo(Pais::class);
    }
    public function agregarEstado(){
        return $this->belongsTo(Estado::class);
    }
    public function agregarMunicipio(){
        return $this->belongsTo(Municipio::class);
    }
    public function agregarUbicacion(){
        return $this->belongsTo(Ubicacion::class);
    }
    public function agregarSucursal(){
        return $this->belongsTo(Sucursal::class);
    }
    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'fk_sucursal', 'pk_sucursal');
    }
    public function agregarNacionalidad(){
        return $this->belongsTo(Nacionalidad::class);
    }
    public function agregarRegimenFiscal(){
        return $this->belongsTo(Regimen_fiscal::class);
    }
    public function regimen_fiscal(){
        return $this->belongsTo(Regimen_fiscal::class, 'fk_regimen_fiscal', 'pk_regimen_fiscal');
    }
    public function agregarUsoCfdi(){
        return $this->belongsTo(Uso_cfdi::class);
    }
    public function uso_cfdi(){
        return $this->belongsTo(Uso_cfdi::class, 'fk_uso_cfdi', 'pk_uso_cfdi');
    }
    public function agregarAgente(){
        return $this->belongsTo(Agente::class);
    }
    public function agente(){
        return $this->belongsTo(Agente::class, 'fk_agente', 'pk_agente');
    }
    public function agregarGrupoCliente(){
        return $this->belongsTo(Grupo_cliente::class);
    }
    public function grupo_cliente(){
        return $this->belongsTo(Grupo_cliente::class, 'fk_grupo_cliente', 'pk_grupo_cliente');
    }
    public function proyecto_general(){
        return $this->hasMany(Proyecto_general::class, 'fk_cliente');
    }
    public function cotizacion(){
        return $this->hasMany(Cotizacion::class, 'fk_cliente');
    }
    public function pago(){
        return $this->hasMany(Pago::class, 'fk_cliente');
    }
}
