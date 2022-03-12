<?php

namespace App\Http\Controllers;
use App\Models\partida;
use App\Models\User;

use Illuminate\Http\Request;

class PartidaController extends Controller
{
    public function store(Request $request)
    {
        $partida = new partida();
                  $partida->partida = $request->input ('partida');
                  $partida->save();
        return response()->json([
            'data' => $partida,
            'msg' => 'Datos Creados '
        ], 200);
    }


     //muestras todos las partidas
     public function show(partida $partida, $id)
     {
         $partida = partida::find($id);
         if(is_null($partida))
         {
             return response()->json([
                 'message' => 'Users Not Found!'
             ], 404);
         }
 
         return response()->json([
             'data' => $partida,
             'message' => 'Users!'
         ], 201);
     }


     public function showUser(User $user, $id)
     {
         $user = User::find($id);
         if(is_null($user))
         {
             return response()->json([
                 'message' => 'Users Not Found!'
             ], 404);
         }
 
         return response()->json([
             'data' => $user,
             'message' => 'Users!'
         ], 201);
     }
 //funcion index trae todos las partidas
     public function index()
     {
         $partida = partida::all();
         return response()->json([
             'data' => $partida,
             'msg' => 'Todas las partidas'
         ], 200);
     }
}
