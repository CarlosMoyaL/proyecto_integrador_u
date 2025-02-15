<?php

namespace App\Http\Controllers;

use App\User;
use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response FK_Usuario_idRolFK
    */
   public function index()
   {
    return view('auth.index')->with('users',User::paginate(10));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       //mostrar el formulario de creacion denuevos usuarios
       return view('auth.create');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(\App\Http\Requests\UserStoreRequest $request)
   {
    $usuario = new  \App\User();
    $usuario->name = $request->input('name');
    $usuario->email =$request->input('email');
    $usuario->password = Hash::make($request->input('password'));
    $usuario->save();
    echo "usuario registrado";
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Usuario  $usuario
    * @return \Illuminate\Http\Response
    */
   public function show(Usuario $usuario)
   {
       return view('auth.show')
       ->with('usuario',$usuario);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Usuario  $usuario
    * @return \Illuminate\Http\Response
    */
   public function edit(Usuario $rolusuario)
   {
    return view('auth.edit')->with('usuario', $usuario);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Usuario  $usuario
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, /*Usuario*/ $usuario)
   {
       $usuario = Usuario::find($usuario);
       $usuario->idRol= $request->input('rol');
       $usuario->save();
       return redirect("rolusuario")->with('mensaje_exito' , "Rol Asignado correctamente");
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Usuario  $usuario
    * @return \Illuminate\Http\Response
    */
   public function destroy(Usuario $usuario)
   {
       //
   }
}
