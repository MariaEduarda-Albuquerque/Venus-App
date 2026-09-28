<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user', [UserController::class, 'indexApi']);
Route::post('/user', [UserController::class, 'storeApi']);
Route::put('/user/{id}', [UserController::class, 'updateApi']);
Route::delete('/user/{id}', [UserController::class, 'destroyApi']);
Route::get('/user-qtd', [UserController::class, 'countUserApi']);

?>