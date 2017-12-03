@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($contents as $content)
        <div class="col-lg-4">
            <div class="box-option">
                <div class="box-top">
                    <div class="box-header">
                    	<span class="box-title">{{ $content->name }}</span>
                    </div>
                </div>
                <a href="{{ url('/contents') }}/{{ $content->name }}" class="box-signup">Ver mais</a>
            </div>
        </div>
        @endforeach

        <br>
        <div class="centered">
            {{ $contents->links() }}
        </div>
    </div>
</div>
@endsection

