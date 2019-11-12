<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ordenes extends Model
{
    protected $table='ordenes';
    protected $primaryKey= 'id';
    protected $fillable = [
        'usuario_id', 'creado_en'
    ];
    public $timestamps = false;
    public $incrementing=true;
}
