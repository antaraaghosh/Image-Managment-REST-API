<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   // return $request->user();
});


Route::post('login',  [AuthController::class, 'login']);

Route::middleware(['auth.jwt'])->group(function () {

   Route::get('/images', [ImagesController::class, 'index']);
   Route::post('/images', [ImagesController::class, 'store']);
   Route::get('/images/{image}', [ImagesController::class, 'show']);
   Route::post('/images/{id}', [ImagesController::class, 'update']);
   Route::delete('/images/{id}', [ImagesController::class, 'destroy']);

});


