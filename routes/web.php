<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController; // Para invocar el controlador y hacer uso de las clases

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*Manera de acceder sin clases - Con resource ya esta linea no es necesaria
Route::get('/empleado', function () {
    return view('empleado.index');
});


// Accediendo con clases - Con resource ya esta linea no es necesaria
Route::get("/empleado/create",[EmpleadoController::class,"create"]);
*/
// Acceder a todos los métodos - ejecutar php artisan route:list

Route::resource("empleado",EmpleadoController::class);
