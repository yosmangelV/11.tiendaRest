<?php

namespace App\Http\Controllers\Orden;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ordenes;
use App\ordenes_detalles;
use App\login;
use DB;
class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $token="0", $id="0")
    {
        $data=$request->all();

        if($token=="0" ||$id=="0"){
            $respuesta=[
                "error"=> true,
                "mensaje"=>"Token y/o usuario invalido",
                "data"=> []
            ];    
        }else{
            $usuario= login::where("token",$token)
                        ->where("id",$id)
                        ->first();
            if($usuario){
                $ordens = ordenes::where('usuario_id',$usuario->id)
                    ->get();
                $detalles=[];
                $producto="";

                foreach ($ordens as $orden) {
                   


                    $detalle = DB::table('ordenes_detalle')
                        ->join('productos', 'ordenes_detalle.producto_id', '=', 'productos.codigo')
                        ->where('ordenes_detalle.orden_id',$orden->id)
                        ->select('productos.*', 'ordenes_detalle.orden_id')
                        ->get();

                    array_push($detalles,[
                        'id'=>$orden->id, 
                        'creado_en'=>$orden->creado_en,
                        'detalle'=>$detalle]);
                        
                }
                $respuesta=[
                    "error"=> false,
                    "usuario"=>$usuario->id,
                    "ordenes"=> $detalles
                ]; 

            }else{
               $respuesta=[
                    "error"=> true,
                    "mensaje"=>"Usuario y Token incorrecto",
                    "data"=> []
                ];  
            }
        }

        return response()->json($respuesta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function destroy(Request $request, $token="0", $id="0",$orden_id="0")
    {
        $data=$request->all();
        
        if($token=="0" || $id=="0" || $orden_id=="0"){
            $respuesta=[
                "error"=> true,
                "mensaje"=>"Token y/o usuario invalido",
                "data"=> []
            ];    
        }else{
            $usuario= login::where("token",$token)
                        ->where("id",$id)
                        ->first();
            if($usuario){
                
                 
                $orden=ordenes::where('id', $orden_id)
                        ->where('usuario_id',$usuario->id)
                        ->first();
                
                if($orden){
                    
                    ordenes_detalles::where('orden_id',$orden->id)->delete();
                    
                    ordenes::destroy($orden->id);

                    $respuesta=[
                        "error"=> false,
                        "usuario"=>"Ordenes Borradas"
                    ];
                }else{
                    $respuesta=[
                        "error"=> true,
                        "mensaje"=>"Esa orden no puede ser borrada",
                        "data"=> []
                    ];  
                }
                
            }else{
               $respuesta=[
                    "error"=> true,
                    "mensaje"=>"Usuario y Token incorrecto",
                    "data"=> []
                ];  
            }
        }

        return response()->json($respuesta);
    }

    public function realizar_orden(Request $request, $token="0", $id="0"){
        
        $data=$request->all();

        if($token=="0" ||$id=="0"){
            $respuesta=[
                "error"=> true,
                "mensaje"=>"Token y/o usuario invalido",
                "data"=> []
            ];    
        }

        if(!isset($data["items"]) || strlen($data['items'])==0){
            $respuesta=[
                "error"=> true,
                "mensaje"=>"Faltan los items",
                "data"=> []
            ];   
        }else{
            $usuario= login::where("token",$token)
                        ->where("id",$id)
                        ->first();


            if($usuario){
                $orden = new \App\ordenes;
                //$orden = ordenes::all();
                
                $orden->usuario_id=$usuario->id;
                $orden->save();

                $items=explode(',',$data['items']);
                $detalle=[];

                foreach ($items as $item) {
                    $insertar = new ordenes_detalles;

                    $insertar->producto_id=$item;
                    $insertar->orden_id=$orden->id;

                    $insertar->save();

                    array_push($detalle,$insertar);
                }

                $respuesta=[
                    "error"=> false,
                    "orden"=>$orden->id,
                    "data"=> $detalle
                ]; 

            }else{
               $respuesta=[
                    "error"=> true,
                    "mensaje"=>"Usuario y Token incorrecto",
                    "data"=> []
                ];  
            }
        }

            

        return response()->json($respuesta);

    }
}
