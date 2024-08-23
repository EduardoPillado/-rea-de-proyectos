<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria_proyecto;

class Categoria_proyecto_controller extends Controller
{
    public function agregarCategoriaProyecto(Request $r){
        $r->validate([
            'nom_cat_proy' => 'required'
        ]);

        $cat_proy=new Categoria_proyecto();
        $cat_proy->nom_cat_proy=$r->nom_cat_proy;
        $cat_proy->save();

        return response()->json([
            'success' => true,
            'categoria_proyecto' => $cat_proy
        ]);
    }
}
