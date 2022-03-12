<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reserva extends Model
{
    use HasFactory;
     
    public $fillable = [
         'numero',
        'n_personas',
        'mountains_id',
        'users_id',
        'partidas_id'
    ];

    // relaciona la tabla montanas para traer el id de la montana
    public function mountains () {
        return $this->belongsTo(mountains::class, 'mountains_id', 'id');
    }
   
 //relaciona a la tabla partida para que el usuario elija sus dos puntos de partida
  
    public function partida() {
        return $this->belongsTo(partida::class, 'partidas_id', 'id');
    
}
// relacion  para saber que usuario hace la reserva
     public function users () {
    return $this->belongsTo(User::class, 'users_id', 'id');
}
}