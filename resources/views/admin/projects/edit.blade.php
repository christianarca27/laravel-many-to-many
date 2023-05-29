@extends('layouts/admin')

@section('content')
    <div class="container">
        <h1>Modifica progetto</h1>

        <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="input-group mb-3">
                <label class="input-group-text" for="title">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    value="{{ old('title') ?? $project->title }}" required minlength="5">

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
                        <option value="{{ $type->id }}"
                            {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
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
                        @if ($errors->any())
                            <input type="checkbox" name="technologies[]" id="technology-{{ $technology->id }}"
                                value="{{ $technology->id }}" @checked(in_array($technology->id, old('technologies', [])))>
                        @else
                            <input type="checkbox" name="technologies[]" id="technology-{{ $technology->id }}"
                                value="{{ $technology->id }}" @checked($project->technologies->contains($technology))>
                        @endif
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
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" required>{{ old('description') ?? $project->description }}</textarea>

                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="url">Url Github</label>
                <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url"
                    value="{{ old('url') ?? $project->url }}" required>

                @error('url')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Modifica</button>

            <a class="btn btn-secondary" href="{{ route('admin.projects.show', $project) }}">Annulla</a>
        </form>
    </div>
@endsection
