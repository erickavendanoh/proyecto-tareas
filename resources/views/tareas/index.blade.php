@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <!--Los corchetes son para insertar dentro código PHP en archivos de blade-->
        <form action="{{ route('tareas') }}" method="post">
            <!--"@csrf" hace referencia a "Cross Site Request Forgery", en Laravel no se permitirá hacer envío de información de formularios salvo que se ponga esta directiva, que previene precisamente los riesgos de seguridad relacionados a ese concepto.-->
            <!--Esto lo que hace es generar una especie de token que solamente reconozca el srvidor web a través de la sesión del usuario. Por lo que atacantes sin este token, válido, no podrán realizar operaciones. *Este valor se verá en el inspeccionar elemento de la página, dentro del formualrio en un input hidden-->
            @csrf

            <!--Para ver el envío de sí fue success desde Controller-->
            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
                <!--Muestra el mensaje, también previamente definido en Controller, en caso de success-->
            @endif
            <!--Sí hubo un error en la validación (desde Controller) con la información ingresada en campo 'title' (no se haya cumplido alguna validación, o error en general)-->
            @error('title')
                <h6 class="alert alert-danger">{{ $message }}</h6>
                <!--$message ya viene inyectada en todas las views, por lo que cualquier error que haya se almacenará y mostrará con esta variable-->
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Título de la tarea</label>
                <input type="text" class="form-control" name="title">
            </div>

            <label for="categoria_id" class="form-label">Categoría de la tarea</label>
            <select name="categoria_id" class="form-select">
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Crear nueva tarea</button>
        </form>
        <!--Para mostrar los registros-->
        <div>
            {{-- $tareas llega de lo definido en TareasController --}}
            @foreach ($tareas as $tarea)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('tareas-edit', ['id' => $tarea->id]) }}">{{ $tarea->title }}</a>
                    </div>

                    <div class="col-md-3 d-flex justify-content-end">
                        {{-- Hay dos formas de mandar info a una ruta (lo que va dentro de los []), con clave valor como arriba ("['id'=> $tarea->id]") o solo con valor y la clave será la misma del campo ("[$tarea->id]") --}}
                        <form action="{{ route('tareas-destroy', [$tarea->id]) }}" method="POST">
                            {{-- El método DELETE es propio de Laravel, ya que en HTML no existe, solo existen GET y POST --}}
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
