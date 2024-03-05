<?php

use App\Http\Controllers\ProdutoController;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//buscar todos os produtos
Route::get('/produto', [ProdutoController::class, 'index']);
//
Route::post('/produto', [ProdutoController::class, 'store']);

Route::get('/produto/{id}', [ProdutoController::class, 'show']);

Route::put('/produto/{id}', [ProdutoController::class, 'update']);

Route::delete('/produto/{id}', [ProdutoController::class, 'destroy']); 

