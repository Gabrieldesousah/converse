@extends('layouts.app')

@section('content')

        <link type="text/css" rel="stylesheet" href="{{ asset('css/chat.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />

<br><br><br>
        <div class="col-lg-3" style="margin: 2% auto;">

            @foreach($chats as $c)            
                <a href="chat/{{ $c->contact_uid }}">Chat {{ $c->contact_uid }}</a>
                <br>
            @endforeach
        </div>

@endsection