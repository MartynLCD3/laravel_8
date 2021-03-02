<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // clave para traer funcionalidades de almacenamiento

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos["empleados"]=Empleado::paginate(5);
        return view("empleado.index",$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("empleado.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosEmpleado = request()->except("_token");
        //verificar si se está insertando una fotografia
        if($request->hasFile("Foto")){
            $datosEmpleado["Foto"]=$request->file("Foto")->store("uploads","public");
        }
        //Llamar al modelo
        Empleado::insert($datosEmpleado);
        //return response()->json($datosEmpleado); 
        return redirect('empleado')->with('mensaje','Empleado añadido con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Recibiendo los datos para ser actualizados posteriormente con update.
        $empleado=Empleado::findOrFail($id);
        return view("empleado.edit", compact("empleado"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosEmpleado = request()->except(["_token","_method"]);
        // Actualización de foto
        if($request->hasFile("Foto")){
            // verificación de usuario y recuperación de datos
            $empleado=Empleado::findOrFail($id);
            Storage::delete("/public".$empleado->Foto);
            $datosEmpleado["Foto"]=$request->file("Foto")->store("uploads","public");
        }
        
        Empleado::where("id","=",$id)->update($datosEmpleado);
        //Retornar los datos actualizados.
        $empleado=Empleado::findOrFail($id);
        return view("empleado.edit", compact("empleado"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado=Empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->Foto)){
            Empleado::destroy($id);
        }
        return redirect('empleado')->with('mensaje','Empleado eliminado de la lista');
    }
}
