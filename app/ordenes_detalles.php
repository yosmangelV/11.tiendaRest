<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ordenes_detalles extends Model
{
    protected $table='ordenes_detalle';
    
    protected $fillable = [
        'orden_id', 'producto_id'
    ];
    public $timestamps = false;
}
