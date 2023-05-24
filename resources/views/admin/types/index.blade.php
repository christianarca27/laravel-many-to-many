@extends('layouts/admin')

@section('content')
    <div class="container">
        <h1>Tipi</h1>

        <a class="btn btn-primary mb-3" href="{{ route('admin.types.create') }}">Inserisci un nuovo tipo</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->slug }}</td>
                        <td>
                            <a href="{{ route('admin.types.show', $type) }}"><i class="fa-solid fa-search"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a class="btn btn-primary mb-3" href="{{ route('admin.types.create') }}">Inserisci un nuovo tipo</a>
    </div>
@endsection
