@extends('app')

@section('content')
    <div class="container w-25 border p-4 my-4">
        <div class="row mx-auto">
            <form action="{{ route('categorias.store') }}" method="post">
                @csrf

                @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
                @endif
                @error('name')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la categoría</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color de la categoría</label>
                    <input type="color" class="form-control" name="color">
                </div>
                <button type="submit" class="btn btn-primary">Crear nueva categoría</button>
            </form>

        </div>
    </div>
@endsection
