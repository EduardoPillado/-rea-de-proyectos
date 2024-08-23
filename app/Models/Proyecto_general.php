<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto_general extends Model
{
    use HasFactory;
    protected $table="proyecto_general";
    protected $primaryKey='pk_proyecto_general';
    public $timestamps=false;
    protected $fillable = [
        'nom_proyecto_general',
        'fk_cliente',
        'fk_sucursal',
        'fk_sistema_riego',
        'fk_cultivo',
        'fecha_inicio',
        'superficie',
        'vigencia_dias',
        'predio',
        'fk_categoria_proyecto',
        'fk_etapa',
        'fk_cotizacion',
        'nom_ubicacion_proyecto',
        'imagen_ubicacion',
        'plano_pdf',
        'importe_total_mn',
        'cantidad_restante_mn',
        'importe_total_dls',
        'cantidad_restante_dls',
        'fk_empleado',
        'estatus',
    ];
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
    public function agregarSistemaRiego(){
        return $this->belongsTo(Sistema_riego::class);
    }
    public function agregarCultivo(){
        return $this->belongsTo(Cultivo::class);
    }
    public function agregarCategoriaProyecto(){
        return $this->belongsTo(Categoria_proyecto::class);
    }
    public function agregarEtapa(){
        return $this->belongsTo(Etapa::class);
    }
    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'fk_cotizacion');
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'fk_cliente');
    }
    public function empleado(){
        return $this->belongsTo(Empleado::class, 'fk_empleado');
    }
    public function productos(){
        return $this->belongsToMany(Producto::class, 'proyecto_producto', 'fk_proyecto_general', 'fk_almacen_existencias')
            ->withPivot('cant_unidades', 'descuento');
    }
    public function proyecto_producto(){
        return $this->hasMany(Proyecto_producto::class, 'fk_proyecto_general');
    }
    public function pago(){
        return $this->hasMany(Pago::class, 'fk_proyecto_general');
    }
    public function entrada(){
        return $this->hasMany(Entrada::class);
    }
    public function salida(){
        return $this->hasMany(Salida::class);
    }
    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'fk_sucursal');
    }
    public function sistema_riego(){
        return $this->belongsTo(Sistema_riego::class, 'fk_sistema_riego');
    }
    public function cultivo(){
        return $this->belongsTo(Cultivo::class, 'fk_cultivo');
    }
    public function categoria_proyecto(){
        return $this->belongsTo(Categoria_proyecto::class, 'fk_categoria_proyecto');
    }
    public function etapa(){
        return $this->belongsTo(Etapa::class, 'fk_etapa');
    }
}
