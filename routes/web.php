<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

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

// Register new route "/" can be called by GET request only
Route::get('/', [PostsController::class, 'index'])
    ->middleware(['auth:admin,web'])
    ->name('home');
Route::get('posts/test', [PostsController::class, 'test']);

Route::resource('posts', PostsController::class)->middleware(['auth:admin,web']);
//Route::resource('departments', Departments::class)->middleware(['auth:admin']);

Route::get('/{guard}/login', [LoginController::class, 'create'])
    ->middleware(['guest:admin,web'])
    ->name('login');
Route::post('/{guard}/login', [LoginController::class, 'store'])
    ->middleware(['guest:admin,web']);

Route::delete('/logout', [LoginController::class, 'destroy'])
    ->middleware(['auth:admin,web'])
    ->name('logout');

Route::get('/register', [RegisterController::class, 'create'])
    ->middleware(['guest'])
    ->name('register');
Route::post('/register', [RegisterController::class, 'store'])
    ->middleware(['guest']);

