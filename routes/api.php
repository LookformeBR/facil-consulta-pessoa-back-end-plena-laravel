<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CidadesController;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/me', [AuthController::class, 'me'])->name('me');
Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');

Route::get('/user', [UserController::class, 'user'])->name('users')->middleware('auth:api');

Route::prefix('cidades')->group(function () {
    Route::get('/', [CidadesController::class, 'index'])->name('cidades');
    Route::get('/{id}/medicos', [CidadesController::class, 'doctors']
    )->name('cidades.listDoctorByCidadeId');
});
