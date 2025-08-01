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


Route::get('/categories', [GameController::class, 'getCategory']);
Route::post('/add/categories', [GameController::class, 'storeCategory']);
Route::post('/categories/{id}', [GameController::class, 'updateCategory']); // or PUT if using Axios
Route::delete('/categories/{id}', [GameController::class, 'destroyCategory']);
// match routes
Route::get('/matches', [GameController::class, 'getMatches']);
Route::post('/add/match', [GameController::class, 'storeMatch']);
Route::post('/matches/{id}', [GameController::class, 'updateMatch']); // or PUT if using Axios
Route::delete('/matches/{id}', [GameController::class, 'destroyMatch']);
// room routes
Route::get('/rooms', [GameController::class, 'getRooms']);
Route::post('/add/room', [GameController::class, 'storeRoom']);
Route::post('/rooms/{id}', [GameController::class, 'updateRoom']); // or PUT if using Axios
Route::delete('/rooms/{id}', [GameController::class, 'destroyRoom']);
