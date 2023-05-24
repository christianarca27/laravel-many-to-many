@extends('layouts/admin')

@section('content')
    <div class="container">
        <h1>{{ $technology->name }}</h1>

        <pre>{{ $technology->slug }}</pre>

        <div class="mb-3">
            <span>{{ $technology->color }}</span>
        </div>

        <div class="mb-3">
            <span>Anteprima pill: </span>
            <span class="badge" style="background-color: {{ $technology->color }}">{{ $technology->name }}</span>
        </div>

        <div class="action d-flex gap-3 mb-3">
            <a class="btn btn-primary" href="{{ route('admin.technologies.edit', $technology) }}">Modifica tecnologia</a>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Elimina
                tecnologia</button>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModallLabel">Conferma eliminazione</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare questa tecnologia?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        <form action="{{ route('admin.technologies.destroy', $technology) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Conferma</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h2>Progetti correlati</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titolo</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Data</th>
                    <th scope="col">URL</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technology->projects as $project)
                    <tr>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->slug }}</td>
                        <td>{{ $project->type?->name }}</td>
                        <td>{{ $project->date }}</td>
                        <td>{{ $project->url }}</td>
                        <td>
                            <a href="{{ route('admin.projects.show', $project) }}"><i class="fa-solid fa-search"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.technologies.index') }}">Torna alla lista completa</a>
    </div>
@endsection
