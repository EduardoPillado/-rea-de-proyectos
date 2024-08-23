<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puesto_empleado;

class Puesto_empleado_controller extends Controller
{
    public function agregarPuestoEmpleado(Request $r){
        $r->validate([
            'nom_puesto' => 'required'
        ]);

        $puesto=new Puesto_empleado();
        $puesto->nom_puesto=$r->nom_puesto;
        $puesto->save();

        return response()->json([
            'success' => true,
            'puesto_empleado' => $puesto
        ]);
    }
}
