@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar comentário</div>
                <div class="panel-body">

                <form action="{{ url('/comments/update') }}" method="post" enctype="multipart/form-data">
					<label for="body">Comentário: </label><br>
					<textarea name="body" id="body" class="input-large form-control" autofocus>{{ $comment->body }}</textarea>

					<input type="hidden" name="id" value="{{ $comment->id }}">
					<input type="hidden" name="material_id" value="{{ $comment->material_id }}">
					<br>
					{{ csrf_field() }}
					<div class="centered">
						<input class="btn btn-default" type="submit" value="Atualizar">
					</div>
				</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection