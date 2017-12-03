@extends('layouts.app')

@section('content')
<?php
if($material->type == "exam")
{
    $type = "Prova";
}elseif($material->type == "list")
{
    $type = "Lista";
}elseif($material->type == "resume")
{
    $type = "Resumo";
}elseif($material->type == "answer")
{
    $type = "Gabarito";
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">{{ $type }} de {{ $material->content }}</div>
                <div class="panel-body">
                    <p>

                    @if($material->professor != '')
                        <b>Professor(a):</b> {{ $material->professor }}<br>
                    @endif
                    @if($material->college != '')
                        <b>Instituição:</b> {{ $material->college }}<br>
                    @endif
                    @if($material->description != '')
                        <b>Descrição:</b> {{ $material->description }}<br>
                    @endif
                    <hr>
                    @if (Auth::guest())
                        <a href="{{ url('/login') }}?url={{$_SERVER['REQUEST_URI']}}">Visualizar</a>
                    @else
                        <a target="_blank" href="{{ url('/file') }}/{{ $material->id }}/{{ $material->file }}">Visualizar</a>
                    @endif

                    @if( Auth::guest() )
                    @else
                    <?php #$user->id == $material->user_id ?>
                        @if( $user->permissions == 1)
                        <td class="col-lg-3 right">
                            <a class="btn btn-warning" href="{{ url('/material/edit') }}/{{ $material->id }}">
                            Editar</a>
                            <a class="btn btn-danger" href="{{ url('/material/destroy') }}/{{ $material->id }}">
                            Apagar</a>
                        </td>
                        @endif
                      @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Comentários</div>
                <div class="panel-body">

                    @if (session('status_comment'))
                        <div class="alert alert-info">
                            {{ session('status_comment') }}
                        </div>
                    @endif

                    @foreach($comments as $c)
                    <div class="col-lg-12 table-container">
                        <table class="table table-stripped">
                            <tr>
                                <td class="col-lg-9">{!! $c->body !!}</td>

                              @if( Auth::guest() )

                              @else
                                @if( $user->id === $c->user_id || $user->permissions == 1)
                                <td class="col-lg-3 right">
                                    <a class="btn btn-warning" href="{{ url('/comments/edit') }}/{{ $c->id }}">
                                    Editar</a>
                                    <a class="btn btn-danger" href="{{ url('/comments/destroy') }}/{{ $c->id }}">
                                    Apagar</a>
                                </td>
                                @endif
                              @endif
                            </tr>
                        </table>
                    </div>
                    @endforeach
                    

                    <div class="col-lg-12">
                      @if( !Auth::guest() )
                        <form action="{{ url('/comments/store') }}" method="post" enctype="multipart/form-data">
                            <label for="body">Comentar: </label><br>
                            <textarea name="body" id="body" class="input-large form-control"></textarea>
                            
                            <input type="hidden" name="material_id" value="{{ $material->id }}">

                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <br>
                            {{ csrf_field() }}
                            <div class="centered">
                                <input class="btn btn-default" type="submit" value="Enviar">
                            </div>
                        </form>
                      @else
 
                        <div class="centered">
                            <a class="btn btn-default" href="{{ url('/login/materials/show/') }}/{{ $material->id }}">Faça login para comentar</a>
                        </div>

                      @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



