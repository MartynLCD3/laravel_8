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
        $datos["empleados"]=Empleado::paginate(1);
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

        $campos = [
                'Nombre'=>'required|string|max:100',
                'ApellidoPaterno'=>'required|string|max:100',
                'ApellidoMaterno'=>'required|string|max:100',
                'Correo'=>'required|email',
                'Foto'=>'required|max:10000|mimes:jpeg,png,jpg,gif',
        ];

        $mensaje = [
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'            
        ];

        $this->validate($request, $campos, $mensaje);

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
        $campos = [
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email'
        ];

        $mensaje = [
            'required'=>'El :attribute es requerido',           
        ];

        if($request->hasFile("Foto")){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg,gif'];
            $mensaje=['Foto.required'=>'La foto es requerida' ];
        }

        $this->validate($request, $campos, $mensaje);

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
        //return view("empleado.edit", compact("empleado"));
        return redirect('empleado')->with('mensaje','Empleado Modificado');
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
