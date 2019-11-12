<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lineas extends Model
{
    protected $table='lineas';
    
    protected $fillable = [
        'linea', 'icono'
    ];
    public $timestamps = false;
}
