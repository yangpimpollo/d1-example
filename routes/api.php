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
Route::get('/home', [AuthController::class, 'home_welcome']);
Route::get('/home.login', [AuthController::class, 'home_login']);
Route::post('/home.login', [AuthController::class, 'login']);     //->middleware('throttle:10,1');    usa cache para limitar intentos de inicio de sesión

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) { return response()->json($request->user()); });

    // zona de panel
    Route::get('/panel', [AuthController::class, 'home_dashboard']);
    Route::post('/panel.logout', [AuthController::class, 'logout']);

    // 1. Rutas de administración
    Route::apiResource('/panel/manage/staff', StaffController::class);
    Route::apiResource('/panel/manage/store', StoreController::class);
    Route::apiResource('/panel/manage/category', CategoryController::class);

    // 2. Rutas de clientes
    Route::apiResource('/panel/clientes/customer', CustomerController::class);

    // 3. Gestion de inventario   
    Route::apiResource('/panel/almacen/inventory', InventoryController::class);

    // 4. Catalogo de productos
    Route::apiResource('/panel/buscador/product', ProductController::class);
    Route::get('/panel/buscador/product/{buscador_product}/store/{store_id}', [ProductController::class, 'search']); // Ruta para búsqueda personalizada de productos

    // 5. Procesamiento de ventas
    Route::apiResource('/panel/ventas/order', OrderController::class);
    Route::apiResource('/panel/ventas/orders.order-detail', OrderDetailController::class);
    

});



    Route::get('/user', function (Request $request) { return $request->user(); });