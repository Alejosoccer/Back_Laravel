<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\mountains;
use App\Models\guia;

class MountainsController extends Controller
{
   public function store(Request $request)
    
   {
//recupero el id de dia se va a guardar con la montana
    $guia= guia::findOrFail($request->input('guias_id'));
    
//creamos una nueva montana con su respectivo guia
        $mountains = new mountains();
                  $mountains->name = $request->input ('name');
                  $mountains->fecha = $request->input ('fecha');
                  $mountains->Itinerario = $request->input ('Itinerario');
                  $mountains->description = $request->input('description');
                  $mountains->photo = $request->file('file')->store('mountains');
                  $mountains->guias_id = $request->guias_id;
                  
                  $guia->mountains()->save($mountains);
              
        return response()->json([
            'data' => $mountains,
            'msg' => 'Datos Creados '
        ], 200);
    }

    public function index()
    {
        $mountains = mountains::all();
        return response()->json([
            'data' => $mountains,
            'msg' => 'Todas las Montañas'
        ], 200);
    }

    public function show(mountains $moutains, $id)
    {
        $mountains = mountains::find($id);
        if(is_null($mountains))
        {
            return response()->json([
                'message' => 'Users Not Found!'
            ], 404);
        }

        return response()->json([
            'data' => $mountains,
            'message' => 'Users!'
        ], 201);
    }

    public function update(Request $request, mountains $mountains, $id)
    {
       $mountains = mountains::find($id);
        if($request->file('file'))
        {
            $profile->storage = $request->file('file')->store('mountains');
           // $profile->storage = $request->file('file2')->store('mountain');

        }
        if(is_null($mountains))
        {
            return response()->json([
                'message' => 'Users Not Found!'
            ], 404);
        }
       $mountains->update($request->all());
      /* $mountains = mountains::find($id);
       $mountains->name = $request->input('name');
       $mountain->detail = $request->input('description');



       $mountains->save();*/
        return response()->json([
            'data' =>$mountains,
            'message' => 'Successfully updated user!!'
        ], 200);
    }

}
