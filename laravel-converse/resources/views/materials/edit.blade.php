@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar</div>
                <div class="panel-body">

                <form action="{{ url('/material/update') }}" method="post" enctype="multipart/form-data">
					<label for="type">Tipo </label><br>
					<select class="input-large form-control" name="type">
						<option value="exam" selected="selected">Prova</option>
						<option value="list">Lista de exercícios</option>
						<option value="answers">Gabaritos e resoluções</option>
						<option value="resume">Resumos e explicações</option>
					</select>


					<label for="content">Disciplina: </label>
					<br>
					<input name="content" list="content" class="input-large form-control" placeholder="Disciplina, ex: Cálculo I" 
					value="{{$material->content}}" required>
					<datalist id="content">
						@foreach($contents as  $content)<option value="{{ $content->name }}">@endforeach
					</datalist>


					<label for="professor">Professor: </label><br>
					<input name="professor" list="professor" class="input-large form-control" 
					value="{{$material->professor}}" placeholder="Nome do Professor">
					<datalist id="professor">
						@foreach($professors as $professor)<option value="{{ $professor->name }}">@endforeach
					</datalist>

					
					<label for="area">Área: </label><br>
					<select class="input-large form-control" name="area">
						<option value="Exatas" selected="selected">Exatas</option>
						<option value="Humanas">Humanas</option>
						<option value="Biologicas">Biológicas</option>
					</select>


					<label for="text">Tópicos, curso e descrição: </label><br>
					<input class="input-large form-control" type='text' name='description' 
					value="{{$material->description}}" placeholder="ex. 1° prova - Produto vetorial e matrizes; eng. civil.."/>


					<label for="college">O material é de qual universidade? </label><br>
					<input name="college" list="college" class="input-large form-control" placeholder="ex: UFG, PUC" 
					value="{{$material->college}}" required>
					<datalist id="college">
						<option value="UFG">UFG</option>
						<option value="UEG">UEG</option>
						<option value="IFG">IFG</option>
						<option value="PUC">PUC</option>
						<option value="UNIP">UNIP</option>
						<option value="Uni-ANHANGUERA">Uni-ANHANGUERA</option>
						<option value="Uni-EVANGÉLICA">Uni-EVANGÉLICA</option>
						<option value="ALFA">ALFA</option>
						<option value="PADRÃO">PADRÃO</option>
						<option value="Outras">Outras</option>
					</datalist>

					<input type="hidden" name="id" value="{{$material->id}}">

					<!--label for="file">
						Arquivo:
						<h5>Não edite se não quiser alterar o arquivo</h5>
					</label><br>
					<input class="input-large form-control" type="file" name="file" required>
					
					<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

					<br-->

					<br>
					{{ csrf_field() }}
					<div class="centered">
						<input class="btn btn-default" type="submit" value="Salvar">
					</div>
				</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection