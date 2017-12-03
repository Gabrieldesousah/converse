@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Compartilhar</div>
                <div class="panel-body">

                @if (session('status_success'))
			        <div class="alert alert-success">
			            {{ session('status_success') }}
			        </div>
			    @elseif (session('status_danger'))
			    	<div class="alert alert-danger">
			            {{ session('status_danger') }}
			        </div>
			    @endif

                @if (Auth::guest())
                    <div class="alert alert-danger">
                    Você não está cadastrado, faça login para gerenciar melhor seus documentos:
				    <br>
				    <a href="{{ url('/login') }}?url={{$_SERVER['REQUEST_URI']}}">Entrar</a>
				    </div>
                    
                @endif

                <form action="{{ url('/materials/store') }}" method="post" enctype="multipart/form-data">
					<label for="type">O que você vai compartilhar? </label><br>
					<select class="input-large form-control" name="type">
						<option value="exam" selected="selected">Prova</option>
						<option value="list">Lista de exercícios</option>
						<option value="answers">Gabaritos e resoluções</option>
						<option value="resume">Resumos e explicações</option>
					</select>


					<label for="content">Disciplina: </label>
					<br>
					<input name="content" list="content" class="input-large form-control" placeholder="Disciplina, ex: Cálculo I" required>
					<datalist id="content">
						@foreach($contents as  $content)<option value="{{ $content->name }}">@endforeach
					</datalist>


					<label for="professor">Professor: </label><br>
					<input name="professor" list="professor" class="input-large form-control" placeholder="Nome do Professor">
					<datalist id="professor">
						@foreach($professors as $professor)<option value="{{ $professor->name }}">@endforeach
					</datalist>

					
					<label for="area">Área: </label><br>
					<select class="input-large form-control" name="area">
						<option value="1">Biológicas</option>
						<option value="2" selected="selected">Exatas</option>
						<option value="3">Humanas</option>
					</select>


					<label for="text">Tópicos, curso e descrição: </label><br>
					<input class="input-large form-control" type='text' name='description' placeholder="ex. 1° prova - Produto vetorial e matrizes; eng. civil.."/>


					<label for="college">O material é de qual universidade? </label><br>
					<select class="input-large form-control" name="college">
						<option value="UFG" selected="selected">UFG</option>
						<option value="UEG">UEG</option>
						<option value="IFG">IFG</option>
						<option value="PUC">PUC</option>
						<option value="UNIP">UNIP</option>
						<option value="Uni-ANHANGUERA">Uni-ANHANGUERA</option>
						<option value="Uni-EVANGÉLICA">Uni-EVANGÉLICA</option>
						<option value="ALFA">ALFA</option>
						<option value="PADRÃO">PADRÃO</option>
						<option value="Outras">Outras</option>
					</select>


					<label for="file">Arquivo:</label><br>
					<input class="input-large form-control" type="file" name="file" required>
					
					<?php 
					if (Auth::guest()){
						$user_id = "";
					} else {
						$user_id = Auth::user()->id;
					}
					?>
					<input type="hidden" name="user_id" value="{{ $user_id }}">

					<br>
					{{ csrf_field() }}
					<div class="centered">
						<input class="btn btn-default" type="submit" value="Enviar">
					</div>
				</form>

				<br><br>
                <div class="alert alert-info"><a target="_blank" href="http://www.camscanner.com/r?203198109">Baixar CamScanner para melhor digitalizar seus arquivos</a></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection