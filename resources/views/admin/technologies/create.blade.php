@extends('layouts/admin')

@section('content')
    <div class="container">
        <h1>Aggiungi tecnologia</h1>

        <form action="{{ route('admin.technologies.store') }}" method="post">
            @csrf

            <div class="input-group mb-3">
                <label class="input-group-text" for="name">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    value="{{ old('name') }}" required>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="color">Colore</label>
                <input type="color" class="form-control @error('color') is-invalid @enderror" name="color"
                    id="color" value="{{ old('color') }}" required>

                @error('color')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <button type="submit" class="btn btn-primary">Inserisci</button>
            </div>
        </form>
    </div>
@endsection
