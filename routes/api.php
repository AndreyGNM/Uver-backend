<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route::post('/viajes', [ApiController::class, 'createTravel']);

// Rutas del login

        // Busqueda usuario - isRegistered():
        Route::get('/usuarios/{telefono}', [ApiController::class, 'show'])->name('usuarios.show');

        /*
        
        isValidCode(): Válida si el código que se envió por SMS corresponde con el que está ingresando el usuario.

        enviarCodigo(): Este método realiza la lógica necesaria para poder enviar el código de confirmación del log-in en la plataforma. 

        
        */


// Rutas del usuario

        // Registrar usuario - registrarUsuario():
        Route::post('/usuarios', [ApiController::class, 'registerUser']);

        // Registrar viaje - createtravel():
        Route::post('/travel', [ApiController::class, 'createtravel']);


// Rutas del conductor

        // Busqueda conductor - isRegisteredAsDriver():
        Route::get('/conductor/{telefono}', [ApiController::class, 'show'])->name('conductor.show');

        // Registrar conductor - registrarConductor():
        Route::post('/conductor', [ApiController::class, 'registrarConductor']);

        // Registrar vehiculo - registrarVehiculo():
        Route::post('/conductor', [ApiController::class, 'registrarVehiculo']);


// Rutas catalogo

        // Obtener todas las licencias - obtenerLicencia():
        Route::get('/licencia', [ApiController::class, 'show'])->name('licencia.show');

        // Obtener todas las licencias  - obtenerModelo():
        Route::get('/modelo', [ApiController::class, 'show'])->name('modelo.show');


//Rutas de viaje

        // Obtener un viaje - obtenerViaje():
        Route::get('/viaje', [ApiController::class, 'show'])->name('viaje.show');
        Route::get('/viajes/{id}', [ApiController::class, 'getTravel']);

        // Actualizar un viaje  - actualizarViaje(): ademas de ser el Asignarle un conductor al viaje  - asignarConductor():

        Route::patch('/viaje/{id}', [ApiController::class, 'update'])->name('viaje.update');
       
        // Eliminar un viaje  - actualizarViaje():
        Route::delete('/viaje/{id}', [ApiController::class, 'destroy'])->name('viaje.destroy');

        

        