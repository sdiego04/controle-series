<?php

use App\Http\Controllers\entrarController;
use App\Http\Controllers\registroController;
use App\Http\Controllers\SeriesControllers;
use App\Http\Controllers\TemporadasController;
use App\Http\Controllers\EpisodiosController;
use App\Http\Middleware\testeLogin;
use Illuminate\Support\Facades\Auth;
use App\Mail\novaSerie;
use Illuminate\Support\Facades\Mail;


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
Route::get('/listaSeries',[SeriesControllers::class, 'listaSeries'])
    ->name('index.listaSeries');
Route::get('/olaMundo',[SeriesControllers::class, 'ola'])
    ->name('index.ola');
Route::get('/criar',[SeriesControllers::class, 'criar'])
    ->name('index.criar')
    ->middleware('auth');

Route::post('/criar',[SeriesControllers::class, 'store'])
    ->name('salvar')
    ->middleware('auth');
Route::post('/removerSerie/{id}+{nome}',[SeriesControllers::class,'destroy'])
    ->middleware('auth');
Route::get('/series/{serieId}/temporadas',[TemporadasController::class,'index']);
Route::get('/alterarSeries/{id}',[SeriesControllers::class,'formAlterar'])
    ->name('alterar')
    ->middleware('auth');
Route::post('/alterarSeriado/{id}',[SeriesControllers::class,'alterarSerie'])
    ->middleware('auth');

Route::get('/temporadas/{temporadaId}/episodios',[EpisodiosController::class,'index'])
     ->name('index.listarEpisodios');

Route::post('/temporadas/{temporada}/episodios/assistir',[EpisodiosController::class,'assistido'])
    ->name('assistido')
    ->middleware('auth');

Route::get('/entrar',[entrarController::class,'index']);
Route::post('/entrar',[entrarController::class,'entrar']);
Route::get('/registrar',[registroController::class,'create']);
Route::post('/registrar',[registroController::class,'store']);
Route::get('/sair',function (){
    Auth::logout();
    return redirect('/entrar');
});

Route::get('/visualizando-email',function (){
    return new novaSerie(
        'Arrow',
        10,
        2,
    );
});
Route::get('/enviando-email',function (){

    $email= new novaSerie(
        'Arrow',
        10,
        2,
    );

    $user=(object)[
        'email'=>'s.diego04@gmail.com',
        'name'=>'Diego'];
    Mail::to($user)->send($email);

    return "Email enviado!";
});







Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
