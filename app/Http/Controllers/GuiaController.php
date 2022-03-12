<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Models\guia;

use Illuminate\Http\Request;

class GuiaController extends Controller
{
    public function store(Request $request)
    {
        $guia = new guia();
                  $guia->name = $request->input ('name');
                  $guia->description = $request->input('description');
                  $guia->ruta = $request->input('ruta');
                  $guia->photo = $request->file('file1')->store('guia');
                  $guia->save();
        return response()->json([
            'data' => $guia,
            'msg' => 'Datos Creados '
        ], 200);
    }

    //muestras todos los guias
    public function show(guia $guia, $id)
    {
        $guia = guia::find($id);
        if(is_null($guia))
        {
            return response()->json([
                'message' => 'Users Not Found!'
            ], 404);
        }

        return response()->json([
            'data' => $guia,
            'message' => 'Users!'
        ], 201);
    }
//funcion index trae todos los guias
    public function index()
    {
        $guia = guia::all();
        return response()->json([
            'data' => $guia,
            'msg' => 'Todas las Montañas'
        ], 200);
    }
//


    


}
