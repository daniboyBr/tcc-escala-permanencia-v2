<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::middleware(['user.active'])->group(function () {
	Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware('user.active');
	Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware('user.active');
	Route::get('/escala', [\App\Http\Controllers\EscalaController::class, 'index'])->name('home-sistema');

	Route::get('/organizacao-militar/{organizacao}/secao', [\App\Http\Controllers\OrganizacaoMilitarController::class, 'secao'])
		->name('organizao-secao')
		->withoutMiddleware('user.active');

	Route::get('/impedimento', [\App\Http\Controllers\ImpedimentoController::class, 'index'])->name('militar-impedimento');
});
