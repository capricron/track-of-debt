<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DebtController,
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
    Route::resource('/task', DebtController::class);
    Route::resource('/', DebtController::class);
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::post('/modif', [DebtController::class, 'modif']);
    Route::put('/modif/{id}', [DebtController::class, 'checked']);
});

Route::get('/login', [LoginController::class, "index"]);
Route::post('/login', [LoginController::class, "authenticate"]);
Route::post('/logout', [LoginController::class, "logout"]);

Route::post('/register', [RegisterController::class, "store"]);
Route::get('/register', [RegisterController::class, "index"]);
