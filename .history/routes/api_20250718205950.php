<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// category routes


Route::get('/categories', [GameController::class, 'index']);
Route::post('/categories', [GameController::class, 'store']);
Route::post('/categories/{id}', [GameController::class, 'update']); // or PUT if using Axios
Route::delete('/categories/{id}', [GameController::class, 'destroy']);
