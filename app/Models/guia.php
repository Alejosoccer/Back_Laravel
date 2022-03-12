<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guia extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'ruta',
        'photo'     
    ];

    public function mountains () {
        return $this->hasOne(guia::class, 'guias_id', 'id');
}
}
