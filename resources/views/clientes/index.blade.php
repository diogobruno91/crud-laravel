@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listagem de Clientes</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1>Clientes</h1>

            @if (session('success'))
                <div class="alert alert-success fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2>Adicionar Novo Cliente</h2>
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="razao_social" class="sr-only">Razão Social</label>
                                <input type="text" name="razao_social" id="razao_social" class="form-control" value="{{ old('razao_social') }}" placeholder="Razão Social" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="cnpj" class="sr-only">CNPJ</label>
                                <input type="text" name="cnpj" id="cnpj" class="form-control" value="{{ old('cnpj') }}" placeholder="CNPJ" pattern="\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email" class="sr-only">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="E-mail" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mb-2 text-center">
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </div>
            </form>

            <h2>Filtrar Clientes</h2>
            <form action="{{ route('clientes.filter') }}" method="GET">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="filter_razao_social" class="sr-only">Razão Social</label>
                            <input type="text" name="razao_social" id="filter_razao_social" class="form-control" value="{{ request('razao_social') }}" placeholder="Razão Social">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="filter_cnpj" class="sr-only">CNPJ</label>
                            <input type="text" name="cnpj" id="filter_cnpj" class="form-control" value="{{ request('cnpj') }}" placeholder="CNPJ">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="filter_email" class="sr-only">E-mail</label>
                            <input type="email" name="email" id="filter_email" class="form-control" value="{{ request('email') }}" placeholder="E-mail">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mb-2 text-center">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Limpar Filtro</a>
                    </div>
                </div>
            </form>

            <h2>Lista de Clientes</h2>
            <div class="table-responsive"  style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Razão Social</th>
                            <th>CNPJ</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->razao_social }}</td>
                                <td>{{ $cliente->cnpj }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bootstrap JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
@endsection