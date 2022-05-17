<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    TaskController,
    LoginController,
    RegisterController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::group(['middleware' => 'login'], function () {
    Route::resource('/task', TaskController::class);
    Route::resource('/', TaskController::class);
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::post('/modif', [TaskController::class, 'modif']);
    Route::put('/modif/{id}', [TaskController::class, 'checked']);
});

Route::get('/login', [LoginController::class, "index"]);
Route::post('/login', [LoginController::class, "authenticate"]);

Route::post('/register', [RegisterController::class, "store"]);
Route::get('/register', [RegisterController::class, "index"]);
