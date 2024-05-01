<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\Tarea;

class TareasController extends Controller
{
    /*
        Laravel emplea una convención de nombres (no es obligatorio nombrarlos igual) para nombrar a métodos predefinidos que hacen cierta función:
        -index: para mostrar todos los datos
        -store: para guardar un dato
        -update: para actualizar un dato
        -destroy: para eliminar un dato
        -edit: para mostrar el formulario de edición
    */

    //Lo correspondiente a lo de acá se ejecutará en web.php con una ruta "::post"

    //$request corresponde a una solicitud Http, que en este caso será para cuando se envie el formulario y llegué con los datos
    public function store(Request $request){
        //validate() permite validar la información insertada en ciertos campos, sin necesidad de if's y cosas así
        //se pone dentro a manera de arreglo el name o id del elemento (HTML) (que en este caso se nombra igual que el campo en el modelo, a partir del cual se hizo la migración y se creo como campo en su respectiva tabla en BD)
        //las validaciones para un mismo campo se separan por "|"
        $request->validate([
            'title' => 'required|min:3'
        ]);

        $tarea = new Tarea;
        $tarea->title = $request->title; //Se asigna, ya validado, el valor en campo HTML al atributo correspondiente del modelo
        $tarea->save(); //método que tienen todos los modelos para poder guardar un nuevo elemento en la BD

        //Ya una vez insertado se va redirige a parte de "tareas" en views, con el mensaje, que se inyecta en la solicitud de respuesta
        return redirect()->route('tareas')->with('success','Tarea creada correctamente');
    }
}
