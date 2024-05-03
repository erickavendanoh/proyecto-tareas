<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();

        return view('categorias.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // color tendrá 7 porque se obtendrá a partir de un <input type="color">, y los valores son en Hexadecimal, que son 6, más la "#"
        $request->validate([
            'name'=> 'required|unique:categorias|max:255',
            'color' => 'required|max:7'
        ]);

        $categoria = new Categoria;
        $categoria->name = $request->name;
        $categoria->color = $request->color;
        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Nueva categoria agregada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.show', ['categoria'=>$categoria]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::find($id);
        $categoria->name = $request->name;
        $categoria->color = $request->color;
        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoria actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $categoria)
    {
        $categoria = Categoria::find($categoria);
        //Para eliminar todas las tareas que estén relacionadas en su campo "categoria_id" con la categoría que se va a eliminar, para que no de error de restricción de FK
        $categoria->tareas()->each(function($tarea){
            $tarea->delete();
        });
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria eliminada!');
    }
}
