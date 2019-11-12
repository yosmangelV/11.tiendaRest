<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    protected $table='productos';
   	
   	protected $primaryKey= 'codigo';

    protected $fillable = [
        'codigo', 'producto','linea', 'linea_id', 'proveedor',
        'descripcion', 'precio_compra'
    ];

    public $incrementing=false;
    public $timestamps = false;
}
