@extends('layouts/admin')

@section('content')
    <div class="container">
        <h1>{{ $project->title }}</h1>

        <pre>{{ $project->type?->name }}</pre>

        <img src="{{ $project->preview }}" alt="">

        <p>Data di pubblicazione: {{ $project->date }}</p>

        <p>{{ $project->description }}</p>

        <a class="d-block mb-3" href="{{ $project->url }}" target="_blank">Vai al progetto Github</a>

        <div class="action d-flex gap-3 mb-3">
            <a class="btn btn-primary" href="{{ route('admin.projects.edit', $project) }}">Modifica progetto</a>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Elimina
                progetto</button>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModallLabel">Conferma eliminazione</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare questo progetto?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Conferma</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.projects.index') }}">Torna alla lista completa</a>
    </div>
@endsection
