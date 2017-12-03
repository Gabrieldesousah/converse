@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Usuários mais ativos</div>
                <div class="panel-body">

                    <ul>
                    @foreach($userData as $u)
                        @if($u->user["name"] != "")
                    	<li>
                    		<b style="text-transform: capitalize;">
                    			{{$u->user["name"]}}:
                    		</b>
                    		{{$u->count}}
                    	</li>
                        @endif
            		@endforeach
                    </ul>

                    <div class="centered">
                        {{ $userData->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



