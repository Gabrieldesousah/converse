@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">{{ $user->name }}</div>
                <div class="panel-body">
                    <p>
                        <b>Nome:</b> {{ $user->name }}<br>
                        <b>Email:</b> {{ $user->email }}<br>

                    @if($user->course != '')
                        <b>Curso:</b> {{ $user->course }}<br>
                    @endif
                    @if($user->college != '')
                        <b>Instituição:</b> {{ $user->college }}<br>
                    @endif
                    @if($user->state != '' and $user->city != '')
                        {{ $user->state }} - {{ $user->city }}<br>
                    @endif
                    
                    <b>Categoria:</b>
                    	@if($user->permissions == 1)
                    		Moderador
                    	@else
                    		Usuário padrão
                    	@endif

                    @if( Auth::user()->permissions == 1)
                        <hr>
                            <td class="col-lg-3 right">
                                <a class="btn btn-warning" href="{{ url('/editprofile') }}/{{ $user->id }}">
                                Editar</a>
                            </td>
                        </p>
                        <a href="{{ url('/users') }}">Voltar a lista de usuários</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection