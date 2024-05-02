<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\CategoriasController;

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

// Route::get('/tareas', function () {
//     return view('tareas.index'); //lo mismo que tareas/index, pero es más común usar el .
// })->name('tareas');

//Lo mismo que MVC en ASP .Net Core, se pone la ruta a la que se hará referencia en navegador, el Controller y el método al que hace referencia esa ruta (ya dentro de los métodos en los Controller es donde se puede poner que regresen un view o un redirect, que sigue llevando a un view de todos modos)

//Otra forma de hacer lo mismo con lo comentado arriba, pero de forma con lo puesto abajo
Route::get('/tareas', [TareasController::class, 'index'])->name('tareas');

//cuando se especifica toda una clase, sin crear un objeto, se debe colocar lo de "::class"
//se especifica, a manera de arreglo, primero la clase, y luego el método de la misma a ejecutar
Route::post('/tareas', [TareasController::class, 'store'])->name('tareas'); //Con lo de "->name('tareas')" es para indicar a que vistas se está refieriendo exactamente, por lo que ya no importará si se cambie lo de dondetro de la función "/*nombre*" ya que se sabrá que seimrpe se referencia a ese conjunto de vistas. Por ej. en form en index.blade.php dentro de views->tareas, en el action= se puso "{{ route('tareas') }}" con lo cuál ya no es necesario poder "/tareas" ya que sabe que es esta porque se le asigno ese nombre (se diferencia del de arriba porque este es POST y el otro es GET)

//rutas referentes a edicion, una para mostrar contenido de registro seleccionado y otra para hacer los cambios
//con "/{id}" se indica que se espera parámetro para esa página, el cuál se pasará y empleará método show de TareasController
Route::get('/tareas/{id}', [TareasController::class, 'show'])->name('tareas-edit');
Route::patch('/tareas/{id}', [TareasController::class, 'update'])->name('tareas-update'); //el que se "ejecutará" cuando se envíe el formualrio de edición

Route::delete('/tareas/{id}', [TareasController::class, 'destroy'])->name('tareas-destroy');

// a diferencia de con Tareas (TareasController) donde se tuvo que definir todas las rutas con respecto a sus métodos para lo de su CRUD, acá ya solo con esta línea después de ejecutar el comando que crea el Controller pero a la vez sus métodos para su CRUD (php artisan make:controller CategoriasController --resource) ya no es necesario definir ruta por ruta
Route::resource('categorias', CategoriasController::class);
