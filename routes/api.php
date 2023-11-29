<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

/**---------------------
 * RUTAS SIN TOKEN
 * ---------------------**/
// Registrar master
Route::post('register/master/24548539', [AuthController::class, 'register_master']);
// Login
Route::post('login', [AuthController::class, 'login']);

/**---------------------
 * RUTAS CON TOKEN
 * ---------------------**/
Route::middleware('auth:sanctum')->group(function () {

    /**---------------------
     * USERS
     * ---------------------**/
    // Validacion de token
    Route::get('user/data', [AuthController::class, 'get_logged_user_data']);
    // Registrar usuario
    Route::post('user/add', [AuthController::class, 'register']);
    Route::get('users', [AuthController::class, 'get_all_users']);
    // Editar color de usuario
    Route::put('user/edit/{user}/color', [AuthController::class, 'edit_color']);

    /**---------------------- 
     * CALLS
     * ----------------------**/
    // Crear llamada
    Route::post('call', [CallController::class, 'create']);
    // Obtener llamadas
    Route::get('call', [CallController::class, 'index']);
    // Obtener llamada por id
    Route::get('call/phone/{phone}', [CallController::class, 'get_call_by_phone']);
    Route::get('call/{call}', [CallController::class, 'get_call_by_id']);
    Route::post('call/comment/{call}', [CallController::class, 'add_comment_to_call']);

    /**---------------------- 
     * CLIENTS
     * ----------------------**/
    // Crear cliente
    Route::post('client', [ClientController::class, 'create']);
    // Crear cliente
    Route::get('client/{client}', [ClientController::class, 'get_client_by_id']);
    // Obtener clientes
    Route::get('client', [ClientController::class, 'index']);
    // Agregar un detalle adicional de cliente
    Route::post('client/info/add/{client}', [ClientController::class, 'add_aditional_info']);

    /**---------------------- 
     * DEPARTMENTS
     * ----------------------**/
    // Obtener departamentos
    Route::get('department', [DepartmentController::class, 'get_all_departments']);
    // Crear departamento    
    Route::post('department', [DepartmentController::class, 'create']);

    /**---------------------
     * SESSION
     * ---------------------**/
    // Cerrar sesion
    Route::get('logout', [AuthController::class, 'logout']);
});
