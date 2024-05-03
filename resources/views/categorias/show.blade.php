@extends('app')

@section('content')
    <div class="container w-25 border p-4 my-4">
        <div class="row mx-auto">
            <form action="{{ route('categorias.update', ['categoria' => $categoria->id]) }}" method="post">
             @method('PATCH')    
                @csrf
                @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
                @endif
                @error('name')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la categoría</label>
                    <input type="text" class="form-control" name="name" value="{{$categoria->name}}">
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color de la categoría</label>
                    <input type="color" class="form-control" name="color" value="{{$categoria->color}}">
                </div>
                <button type="submit" class="btn btn-primary">Actualizar categoría</button>
            </form>

            <div>
                <!-- el método tareas() de su modelo -->
                @if($categoria->tareas->count() > 0)
                @foreach ($categoria->tareas as $tarea)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('tareas-edit', ['id' => $tarea->id]) }}">{{ $tarea->title }}</a>
                    </div>

                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{ route('tareas-destroy', [$tarea->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
                @endforeach
                
                @else
                    No hay tareas para esta categoría
                @endif
            </div>
        </div>
    </div>
@endsection
