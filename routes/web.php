<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('app');
});

Route::get('/saludos', function () {
    return view('app');
});

Route::get('/services', function () {
    return 'Hola a todos desde esta ruta';
});

*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tareas', function () {
    return view('tareas.index'); //lo mismo que tareas/index, pero es más común usar el .
});

//cuando se especifica toda una clase, sin crear un objeto, se debe colocar lo de "::class"
Route::post('/tareas', [TareasController::class, 'store']); //se especifica, a manera de arreglo, primero la clase, y luego el método de la misma a ejecutar
