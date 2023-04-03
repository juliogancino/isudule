<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\BladeProfeHorasController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\UserController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//my routes

Route::get('/newhorario',[App\Http\Controllers\AdminController::class, 'index'])->name('newhorario');

//horarios
Route::get('/hora/allhorario', [HorarioController::class, 'index'])->name('listhorario');
Route::post('/hora/addhorario', [HorarioController::class, 'store'])->name('savehorario');
Route::get('/hora/edithorario/{id}', [HorarioController::class, 'edit'])->name('edithorario');
Route::post('/hora/updahorario/{id}', [HorarioController::class, 'update'])->name('updahorario');

//clases
Route::any('/hora/addclase', [ClaseController::class, 'store'])->name('saveclass');
Route::get('/hora/editclase/{id}', [ClaseController::class, 'show'])->name('editclass');
Route::get('/hora/delclase/{id}', [ClaseController::class, 'destroy'])->name('delclass');
Route::get('/hora/deldosclase/{id}/{hid}', [ClaseController::class, 'deldosclass'])->name('deldosclass');
Route::get('horario/export/{h_id}', [ClaseController::class, 'exportHorario'])->name('exporthorario');


//ajax
Route::get('/ajax/gethorasprofe',[BladeProfeHorasController::class, 'getHorasProfeAjax'])->name('getDataProfe');
Route::get('/ajax/gethorasprofe',[BladeProfeHorasController::class, 'index'])->name('getProfes');

//profesor
Route::get('/profe/nuevo',[ProfesorController::class, 'create'])->name('newprofe');
Route::get('/profe/edita/{id}',[ProfesorController::class, 'edit'])->name('editprofe');
Route::get('/profe/all',[ProfesorController::class, 'index'])->name('listprofe');
//Route::get('/profe/actualizah/{id}{peri}',[ProfesorController::class, 'updateHorasProfe'])->name('actuahprofe');
Route::post('/profe/actualizahd',[ProfesorController::class, 'updateHorasProfedos'])->name('actuahprofedos');
Route::post('/profe/guarda',[ProfesorController::class, 'store'])->name('saveprofe');
//Route::get('/profe/horario/{id}/{mod}',[ProfesorController::class, 'showhorario'])->name('profehorario');
Route::post('/profe/horario/',[ProfesorController::class, 'showhorario'])->name('profehorariodos');
//Route::get('/profe/exportp/{id}', [ProfesorController::class, 'exportProfesor'])->name('exportprofesor');
Route::post('/profe/exportp/', [ProfesorController::class, 'exportProfesor'])->name('exportprofesordos');


//Excel
Route::get('users/export/', [UserController::class, 'export'])->name('exportusers');

