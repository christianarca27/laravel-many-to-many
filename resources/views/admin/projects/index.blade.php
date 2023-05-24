@extends('layouts/admin')

@section('content')
    <div class="container">
        <h1>Progetti</h1>

        <a class="btn btn-primary mb-3" href="{{ route('admin.projects.create') }}">Inserisci un nuovo progetto</a>

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
                @foreach ($projects as $project)
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

        <a class="btn btn-primary mb-3" href="{{ route('admin.projects.create') }}">Inserisci un nuovo progetto</a>
    </div>
@endsection
