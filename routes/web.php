<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//para enviar los correos
Route::get('send-mail', function () {

    $details = [
        'title' => 'Email enviado por Turisk',
        'body' => 'Gracias por hacer tu reserva para mas informacion revisa tu perfil'
        
    ];

    \Mail::to('aelr238@gmail.com')->send(new \App\Mail\MyTestMail($details));

    dd("Correo Enviado Correctamente.");
});
