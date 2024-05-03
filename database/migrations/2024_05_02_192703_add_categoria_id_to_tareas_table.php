<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //  migración creada para editar la tabla tareas, para asignar una categoria mediante id a cada tarea, agregandole un campo "category_id" que hace referencia a cierto id en categorias (después del campo "title")
    public function up(): void
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->bigInteger('categoria_id')->unsigned();
            $table
                ->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tareas', function (Blueprint $table) {
            //
        });
    }
};
