<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class partida extends Model
{
    use HasFactory;

    public $fillable = [
        'partida'     
    ];


    public function partida() {
        return $this->belongsTo(reserva::class, 'partidas_id', 'id');
}
}