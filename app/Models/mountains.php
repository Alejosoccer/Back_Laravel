<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mountains extends Model
{
    use HasFactory;

    
    public $fillable = [
        'name',
        'description',
        'fecha',
        'Itinerario',
        'photo',
        'guias_id'     
    ];
//Con esto vamos a relacionar la tabla de montana con guia
    public function guias () {
        return $this->belongTo('App\guias', 'guias_id', 'id');
    }

    public function mountains () {
        return $this->belongsTo(reserva::class, 'mountains_id', 'id');
}
}