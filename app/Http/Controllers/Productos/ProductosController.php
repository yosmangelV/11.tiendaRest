<?php

namespace App\Http\Controllers\Productos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\productos;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos=productos::all();

        return response()->json(['productos'=> $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pagination()
    {

        $cantidad=10;

        $productos=productos::paginate($cantidad);

        return response()->json([
            'error'=>false,
            'productos'=> $productos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function findType($type){

        $cantidad=10;

        $productos=productos::where('linea_id',$type)
                    ->paginate($cantidad);

        return response()->json([
                'error'=>false,
                'productos'=> $productos
        ]);
    }

    public function findAll($type){

        $paginate=10;

        $productos=productos::where('codigo','like', $type)
                    ->orWhere('producto','like', $type)
                    ->orWhere('linea','like', $type)
                    ->orWhere('proveedor','like', $type)
                    ->orWhere('precio_compra','like', $type)
                    ->paginate($paginate);

        return response()->json([
                'error'=>false,
                'productos'=> $productos
        ]);
    }
}
