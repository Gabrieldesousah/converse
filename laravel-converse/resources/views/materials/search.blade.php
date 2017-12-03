@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Resultado da pesquisa de "{{ $search }}"</div>
                <div class="panel-body">
			    	<div class="table-container">
			    		<table claass="table table-striped col-lg-12">
			    		<tbody>
			    		@if( $materials == null )
			    		:/ Infelizmente não encontramos nada sobre "{{ $search }}".
			    		<br>
			    		Tente utilizar outros termos ou então <a href="{{ url('/materials/share')}}">compartilhe o que você tem</a>

			    		@endif
					        @foreach($materials as $material)
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
					        <tr>
					        	<td>{{ $type }} de {{ $material->content }}</td>
					            <td>{{ $material->professor }}</td>
					            <td>{{ $material->description }}</td>
					            <td>{{ $material->college }}</td>
					            <td><a href="{{ url('/material') }}/{{ $material->id }}" class="box-signup">Ver mais</a></td>
					        </tr>
					        @endforeach
					    </tbody>
			        	</table>
        			</div>
    		    </div>
	        </div>
        </div>
    </div>
</div>
@endsection