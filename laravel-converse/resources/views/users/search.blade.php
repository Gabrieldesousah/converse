@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Usuários encontrados para " {{ $search }}"
                </div>
                <div class="panel-body">
                    <div class="table-container">
                    <form action="{{ url('/users/search') }}" method="GET">
                        <input type="text" name="key" class="form-control" placeholder="Pesquisar usuários">
                    </form>
	                    <table class="table table-condensed table-hover table-striped table-bordered col-lg-12">
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->course }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td><a href="{{ url('/user') }}/{{ $user->id }}">Visualizar</a></td>
                            </tr>
                            @endforeach
                        </table>

                        <br><br>
                        <a href="{{ url('/users') }}">Voltar a lista de usuários</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
