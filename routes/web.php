<?php

use App\Mail\PermanenciaDelivery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

Route::get('envio-email', function(){
	$user = new stdClass();
	$user->email = 'admin@permanencia.com';
	$user->name = 'Admin Enviando Email';
	// return new PermanenciaDelivery($user);
	Mail::send(new PermanenciaDelivery($user));
});

Auth::routes();

Route::middleware(['user.active'])->group(function () {
	Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware('user.active');
	Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware('user.active');
	Route::get('/escala', [\App\Http\Controllers\EscalaController::class, 'index'])->name('home-sistema');
	Route::post('/escala', [\App\Http\Controllers\EscalaController::class, 'index'])->name('home-sistema');

	Route::get('/organizacao-militar/{organizacao}/secao', [\App\Http\Controllers\OrganizacaoMilitarController::class, 'secao'])
		->name('organizao-secao')
		->withoutMiddleware('user.active');

	Route::get('/impedimento', [\App\Http\Controllers\ImpedimentoController::class, 'index'])->name('militar-impedimento');

	Route::prefix('private')->group(function () {
		Route::get('files/{filename}',[\App\Http\Controllers\PrivateFilesController::class,'show'])->name('private-files');
	});
});
