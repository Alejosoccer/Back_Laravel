<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mountains;
use App\Models\User;
use App\Models\partida;
use App\Models\reserva;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        //recupera el id de la tabla montanas 
        $mountains= mountains::findOrFail($request->input('mountains_id'));
        // recupera el id de la tabla partida 
        $partidas= partida::findOrFail($request->input('partidas_id'));
      //  $users= User::findOrFail($request->input('users_id'));
        //recupera al usuario autenticado
        $id = Auth::id();
        //busca el id que recupera en la lina 21
        $users = User::find($id);
//crea una nueva reserva
         $reserva = new reserva();
                  $reserva->numero = $request->input ('numero');
                  $reserva->n_personas = $request->input('n_personas');
                  $mountains->mountians_id = $request->mountains_id;
                  $partidas->partidas_id = $request->partidas_id;
                  $users->users_id = $request->users_id;
                  // asciar la relacion con la tgabla reservas con la de montanas
                  $reserva->mountains()->associate($mountains);
                  //asosar la relacion con la tabla reservas con la tabla partida
                  $reserva->partida()->associate($partidas);
                  $users->users()->save($reserva);
                /*  $reserva->users()->associate($users);
                  $reserva->save();*/
            return response()->json([
            'data' => $reserva,
            'msg' => 'Datos Creados '
        ], 200);
    }

    //muestras todos los guias
    public function show(reserva $reserva, $id)
    {
        //busca el id de la reserva solo de un dato
        $reserva = reserva::find($id);
        if(is_null($reserva))
        {
            // si no exite ve arroja ese error
            return response()->json([
                'message' => 'Reserva no encontrada '
            ], 404);
        }
//esta es la respuesta si encuentra la reserva el is
        return response()->json([
            'data' => $reserva,
            'message' => 'Accion realizada con exito'
        ], 201);
    }
//funcion index trae todos los guias
    
public function index()
    {//recupera todas las reservas de la base
        $reserva = reserva::all();
        return response()->json([
            'data' => $guia,
            'msg' => 'Todas las Montañas'
        ], 200);
    }
//

public function index2()
{
    $id = Auth::id();
    $users = User::findOrFail($id);
    $reserva = DB::table('reservas')->where('users_id', '=', $id)->get();
  // $profile = Profile::find($id)->where('users_id', '=', $id)->first();

    return response()->json([
        'users' => $users,
       'data' => $reserva,
        'message' => 'Users!'
    ], 201);
}
    
public function perfil()
{
    $id = Auth::id();
    $users = User::findOrFail($id);
    $reserva =  DB::table('reservas')
                ->leftJoin('mountains', 'mountains.id', '=', 'reservas.mountains_id' )
                ->leftJoin('partidas', 'partidas.id', '=', 'reservas.partidas_id')
                ->where('users_id', '=', $id)
                ->select('mountains.name as montana', 'mountains.fecha as fecha', 'partidas.partida as partida', 'reservas.numero', 'reservas.n_personas', 'reservas.id as id' )
                ->get();
    return response()->json([
        'users' => $users,
        'data' => $reserva,
        'message' => 'Users!'
    ], 201);        
}

public function destroy(reserva $reserva, $id)
{
    $reserva = DB::table('reservas')->where('id', $id)->first();
  
    DB::table('reservas')->where('id', $id)->delete();

    return response()->json([
        null,
        'message' => 'Reserva Eliminada !'
    ], 200);
}


function update (Request $request, reserva $reserva, $id)
    {
        $reserva = reserva::find($id);
        if(is_null($reserva)){
            return response()->json(['message' => 'Credito Extra no encontrado '], 404);
        }
        $reserva->update($request->all());

        return response()->json(
            $reserva, 200

        );

    }

}
