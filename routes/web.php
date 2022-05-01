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

	Route::prefix('private')->group(function () {
		Route::get('files/{folder}/{path}',[\App\Http\Controllers\PrivateFilesController::class,'show'])->name('private-files');
	});

	Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware('user.active');
	Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware('user.active');
	Route::get('/escala', [\App\Http\Controllers\EscalaController::class, 'index'])->name('home-sistema');
	Route::post('/escala', [\App\Http\Controllers\EscalaController::class, 'index'])->name('home-sistema');



	Route::get('/secao', [\App\Http\Controllers\SecaoController::class, 'index']);
    Route::get('/secao/create', [\App\Http\Controllers\SecaoController::class, 'create'])->name('create-secao');
    Route::post('/secao/create', [\App\Http\Controllers\SecaoController::class, 'create']);
    Route::get('/secao/{id}/update', [\App\Http\Controllers\SecaoController::class, 'edit'])->name('update-secao');
    Route::put('/secao/{id}/update', [\App\Http\Controllers\SecaoController::class, 'edit']);
    Route::get('/secao/{id}', [\App\Http\Controllers\SecaoController::class, 'show'])->name('view-secao');

	Route::get('/posto-graduacao', [\App\Http\Controllers\PostoGraduacaoController::class, 'index']);
    Route::get('/posto-graduacao/create', [\App\Http\Controllers\PostoGraduacaoController::class, 'create'])->name('create-graduacao');
    Route::post('/posto-graduacao/create', [\App\Http\Controllers\PostoGraduacaoController::class, 'create']);
    Route::get('/posto-graduacao/{id}/update', [\App\Http\Controllers\PostoGraduacaoController::class, 'edit'])->name('update-graduacao');
    Route::put('/posto-graduacao/{id}/update', [\App\Http\Controllers\PostoGraduacaoController::class, 'edit']);
    Route::get('/posto-graduacao/{id}', [\App\Http\Controllers\PostoGraduacaoController::class, 'show'])->name('view-graduacao');

	Route::get('/posto-servico', [\App\Http\Controllers\PostoServicoController::class, 'index']);
    Route::get('/posto-servico/new', [\App\Http\Controllers\PostoServicoController::class, 'createNewPostoServico'])->name('create-posto');
    Route::post('/posto-servico/new', [\App\Http\Controllers\PostoServicoController::class, 'createNewPostoServico']);
    Route::get('/posto-servico/{id}/update', [\App\Http\Controllers\PostoServicoController::class, 'updatePostoServico'])->name('update-posto');
    Route::put('/posto-servico/{id}/update', [\App\Http\Controllers\PostoServicoController::class, 'updatePostoServico']);
    Route::get('/posto-servico/{id}', [\App\Http\Controllers\PostoServicoController::class, 'getPostoServico'])->name('view-posto');

    Route::get('/organizacao-militar', [\App\Http\Controllers\OrganizacaoMilitarController::class, 'index']);
    
    Route::get('/organizacao-militar/{organizacao}/secao', [\App\Http\Controllers\OrganizacaoMilitarController::class, 'secao'])
        ->name('organizao-secao')
        ->withoutMiddleware('user.active');
    
    Route::get('/organizacao-militar/create', [\App\Http\Controllers\OrganizacaoMilitarController::class, 'create'])->name('create-organizacao');
    Route::post('/organizacao-militar/create', [\App\Http\Controllers\OrganizacaoMilitarController::class, 'create']);
    Route::get('/organizacao-militar/{id}/update', [\App\Http\Controllers\OrganizacaoMilitarController::class, 'edit'])->name('update-organizacao');
    Route::put('/organizacao-militar/{id}/update', [\App\Http\Controllers\OrganizacaoMilitarController::class, 'edit']);
    Route::get('/organizacao-militar/{id}', [\App\Http\Controllers\OrganizacaoMilitarController::class, 'show'])->name('view-organizacao');

	Route::get('/impedimento', [\App\Http\Controllers\ImpedimentoController::class, 'index'])->name('militar-impedimento');
    Route::get('/impedimento/{militar_id}',[\App\Http\Controllers\ImpedimentoController::class, 'show'])->name('view-impedimento');
    Route::get('/impedimento/militar/{militar_id}/create',[\App\Http\Controllers\ImpedimentoController::class, 'create'])->name('create-impedimento');
    Route::post('/impedimento/militar/{militar_id}/create',[\App\Http\Controllers\ImpedimentoController::class, 'store']);

    Route::get('/militar/new-user/', [\App\Http\Controllers\MilitarController::class, 'createNewUserWithMilitar'])->name('create-militar-new');
    Route::post('/militar/new-user/', [\App\Http\Controllers\MilitarController::class, 'createNewUserWithMilitar'])->name('create-militar-new');
    Route::post('/militar/liberar/', [\App\Http\Controllers\MilitarController::class, 'liberarUsuario'])->name('militar-liberar');
    Route::post('/militar/perfil/', [\App\Http\Controllers\MilitarController::class, 'liberarUsuarioComoAdmin'])->name('militar-perfil');
    Route::get('/militar/', [\App\Http\Controllers\MilitarController::class, 'index'])->name('militar-list');

    Route::get('/militar/create', [\App\Http\Controllers\MilitarController::class, 'create'])->name('create-militar')->withoutMiddleware('militar');
    Route::post('/militar/create', [\App\Http\Controllers\MilitarController::class, 'store'])->name('store-militar')->withoutMiddleware('militar');
    Route::get('/militar/{id}/update', [\App\Http\Controllers\MilitarController::class, 'edit'])->name('update-militar');
    Route::post('/militar/{id}/update', [\App\Http\Controllers\MilitarController::class, 'update'])->name('update-militar');

});
