<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\lineas;
use App\login;
use App\ordenes;
use App\ordenes_detalles;
use App\productos;

class TestController extends Controller
{
    public function test(){
    	$test=productos::all();

    	return response()->json($test);
    }

    public function home(){
    	return view('welcome');
    }
}
