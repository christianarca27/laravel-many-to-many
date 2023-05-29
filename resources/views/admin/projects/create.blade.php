@extends('layouts/admin')

@section('content')
    <div class="container">
        <h1>Aggiungi progetto</h1>

        <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="input-group mb-3">
                <label class="input-group-text" for="title">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    value="{{ old('title') }}" required minlength="5">

                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="type_id">Tipo</label>
                <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id" required>
                    <option value="" selected>Nessuno</option>

                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>

                @error('type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input type="checkbox" name="technologies[]" id="technology-{{ $technology->id }}"
                            value="{{ $technology->id }}" @checked(in_array($technology->id, old('technologies', [])))>
                        <label for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                    </div>
                @endforeach

                @error('technologies')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="preview">Anteprima</label>
                <input type="file" class="form-control @error('preview') is-invalid @enderror" name="preview"
                    id="preview">

                @error('preview')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="description">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" required>{{ old('description') }}</textarea>

                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="url">Url Github</label>
                <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url"
                    value="{{ old('url') }}" required>

                @error('url')
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
