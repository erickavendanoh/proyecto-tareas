@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
      <!--Los corchetes son para insertar dentro código PHP en archivos de blade-->
        <form action="{{ route('tareas') }}" method="post">
          <!--"@csrf" hace referencia a "Cross Site Request Forgery", en Laravel no se permitirá hacer envío de información de formularios salvo que se ponga esta directiva, que previene precisamente los riesgos de seguridad relacionados a ese concepto.-->
          <!--Esto lo que hace es generar una especie de token que solamente reconozca el srvidor web a través de la sesión del usuario. Por lo que atacantes sin este token, válido, no podrán realizar operaciones. *Este valor se verá en el inspeccionar elemento de la página, dentro del formualrio en un input hidden-->
          @csrf 
          
          <!--Para ver el envío de sí fue success desde Controller-->
          @if(session('success'))
            <h6 class="alert alert-success">{{session('success')}}</h6><!--Muestra el mensaje, también previamente definido en Controller, en caso de success-->
          @endif
          <!--Sí hubo un error en la validación (desde Controller) con la información ingresada en campo 'title' (no se haya cumplido alguna validación, o error en general)-->
          @error('title')
            <h6 class="alert alert-danger">{{ $message }}</h6> <!--$message ya viene inyectada en todas las views, por lo que cualquier error que haya se almacenará y mostrará con esta variable-->
          @enderror
          <div class="mb-3">
              <label for="title" class="form-label">Título de la tarea</label>
              <input type="text" class="form-control" name="title">
            </div>
            <button type="submit" class="btn btn-primary">Crear nueva tarea</button>
          </form>
          <!--Para mostrar los registros-->
          <div>
            @foreach ($tareas as $tarea)
              
            @endforeach
          </div>
    </div>
@endsection
