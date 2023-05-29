@extends('layouts/admin')

@section('content')
    <div class="container">
        <h1>Modifica tipo</h1>

        <form action="{{ route('admin.types.update', $type) }}" method="post">
            @csrf
            @method('PUT')

            <div class="input-group mb-3">
                <label class="input-group-text" for="name">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    value="{{ old('name', $type->name) }}" required>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="description">Descrizione</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $type->description) }}</textarea>

                @error('description')
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
