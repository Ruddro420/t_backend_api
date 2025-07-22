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
//get matches by id
Route::get('/get/matches/{id}', [GameController::class, 'getMatchById']);
// room routes
Route::get('/rooms', [GameController::class, 'getRooms']);
Route::post('/add/room', [GameController::class, 'storeRoom']);
Route::post('/rooms/{id}', [GameController::class, 'updateRoom']); // or PUT if using Axios
Route::delete('/rooms/{id}', [GameController::class, 'destroyRoom']);
// payment routes
Route::get('/deposites', [GameController::class, 'getDeposit']);
Route::post('/add/deposite', [GameController::class, 'storeDeposite']);
Route::post('/deposites/{id}/{status}', [GameController::class, 'updateDeposite']);
// need deposite by user id
Route::get('/deposites/user/{userId}', [GameController::class, 'getDepositByUserId']);
// game entry routes
Route::post('/game-entry', [GameController::class, 'storeGame']);
// check if user already has a game entry
Route::get('/game-entry/check/{userId}', [GameController::class, 'checkGameEntry']);
// check how many games a user has joined
Route::get('/game-entry/count/{matchID}', [GameController::class, 'countGameEntries']);
// check join match using user id
Route::get('/game-entry/user/{userId}', [GameController::class, 'getJoinByUserId']);
// sum pay amount by user id
Route::get('/game-entry/sum-pay/{userId}', [GameController::class, 'sumPayByUserId']);
// settings routes
Route::get('/settings', [GameController::class, 'getSettings']);




/* 



VITE_AUTH_USERNAME=admin@gmail.com
VITE_AUTH_PASSWORD=admin
VITE_SERVER_API=https://game.aliruddro.site/api
VITE_FILE_API=https://game.aliruddro.site

*/