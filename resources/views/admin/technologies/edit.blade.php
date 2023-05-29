@extends('layouts/admin')

@section('content')
    <div class="container">
        <h1>Modifica tecnologia</h1>

        <form action="{{ route('admin.technologies.update', $technology) }}" method="post">
            @csrf
            @method('PUT')

            <div class="input-group mb-3">
                <label class="input-group-text" for="name">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    value="{{ old('name', $technology->name) }}" required>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="color">Colore</label>
                <input type="color" class="form-control @error('color') is-invalid @enderror" name="color"
                    id="color" value="{{ old('color', $technology->color) }}" required>

                @error('color')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <button type="submit" class="btn btn-primary">Modifica</button>
            </div>
        </form>
    </div>
@endsection
