@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('tareas-update', ['id'=>$tarea->id]) }}" method="post">
            @method('PATCH')
            @csrf

          @if(session('success'))
            <h6 class="alert alert-success">{{session('success')}}</h6>
          @endif
          @error('title')
            <h6 class="alert alert-danger">{{ $message }}</h6>
          @enderror
          <div class="mb-3">
              <label for="title" class="form-label">Título de la tarea</label>
              {{-- $tarea llega de lo definido en el controller --}}
              <input type="text" class="form-control" name="title" value="{{ $tarea->title }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar tarea</button>
          </form>
    </div>
@endsection
