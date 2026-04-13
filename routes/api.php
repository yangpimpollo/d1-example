<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\AuthController;   
use App\Http\Controllers\StaffController; 
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;

// pagina de inicio [testeado ✅]
Route::get('/home', function (Request $request) { return response()->json([ 'message' => 'Welcome ComePizza!🍕 API','by' => 'yangpimpollo' ]); });
Route::get('/home.login', function (Request $request) { return response()->json([ 'message' => 'iniciar sección']); });
Route::post('/home.login', [AuthController::class, 'login']);     //->middleware('throttle:10,1');    usa cache para limitar intentos de inicio de sesión

Route::middleware('auth:sanctum')->group(function () {

    // cierre de sesión
    Route::post('/logout', [AuthController::class, 'logout']);

    // 1. Rutas de administración
    Route::apiResource('staffs', StaffController::class);
    Route::apiResource('stores', StoreController::class);
    Route::apiResource('categories', CategoryController::class);

    // 2. Rutas de clientes
    Route::apiResource('customers', CustomerController::class);

    // 3. Gestion de inventario   
    Route::apiResource('inventories', InventoryController::class);

    // 4. Catalogo de productos
    Route::apiResource('products', ProductController::class);

    // 5. Procesamiento de ventas
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('orders.order-details', OrderDetailController::class);
    
});




    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });