<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\login;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function login(Request $request){
        $data=$request->all();

        if(!isset($data['correo']) || !isset($data['contrasena'])){
            $respuesta=[
                "error"=> true,
                "mensaje"=>"La informacion enviada no es valida",
                "data"=> []
            ];    
        }else{
            $login=login::where('correo',$data['correo'])
                    ->where('contrasena', $data['contrasena'])
                    ->first();

            if($login){
                $token=Str::random(20);

                $login->token=$token;
                $login->save();
                 $respuesta=[
                    "error"=> false,
                    "token"=>$token,
                    "id_usuario"=> $login->id
                ];  
            }else{
                 $respuesta=[
                    "error"=> true,
                    "mensaje"=>"Usuario y/o contrasena no son validos",
                    "data"=> []
                ];  
            }
        }
        return response()->json($respuesta);
    }
}
