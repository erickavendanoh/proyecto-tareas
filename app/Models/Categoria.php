<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tarea;

class Categoria extends Model
{
    use HasFactory;

    //Para devolver todas las tareas asociadas a la respectiva categoría
    public function tareas(){
        return $this->hasMany(Tarea::class);
    }
}
