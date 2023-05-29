@extends('layouts/admin')

@section('content')
    <div class="container">
        <h1>Aggiungi tipo</h1>

        <form action="{{ route('admin.types.store') }}" method="post">
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
                <label class="input-group-text" for="description">Descrizione</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>

                @error('description')
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
