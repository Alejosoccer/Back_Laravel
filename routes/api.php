<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MountainsController;
use App\Http\Controllers\GuiaController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\ReservaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup',  [AuthController::class, 'signup']);

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user',  [AuthController::class, 'user']);
        //rutas para guardar las fotos de las montanas
        Route::post('mountains',  [MountainsController::class, 'store']);
        Route::get('mountains',  [MountainsController::class, 'index']);
        Route::put('mountains/{id}',  [MountainsController::class, 'update']);
        //Traer una montana q selecciona por el id
        Route::get('mountains/{id}',  [MountainsController::class, 'show']);
        
        //rutas guia Get y post
        Route::post('guia',  [GuiaController::class, 'store']);
        Route::get('guia',  [GuiaController::class, 'index']);
        Route::get('guia/{id}',  [GuiaController::class, 'show']);
        
        //Rutas partida
        Route::post('partida',  [PartidaController::class, 'store']);
        Route::get('partida',  [PartidaController::class, 'index']);
        Route::get('partida/{id}',  [PartidaController::class, 'show']);
        Route::get('partida/{id}',  [PartidaController::class, 'showUser']);
   //rutas reserva
   Route::post('reserva',  [ReservaController::class, 'store']);
   Route::get('reserva',  [ReservaController::class, 'index']);
   Route::get('reserva/{id}',  [ReservaController::class, 'show']);
   Route::get('reservaPerfil',  [ReservaController::class, 'index2']);
   Route::get('reservaPerfil2',  [ReservaController::class, 'perfil']);
   Route::delete('reserva/{id}',  [ReservaController::class, 'destroy']);
   Route::put('reserva/{id}',  [ReservaController::class, 'update']);
        

    });
});
