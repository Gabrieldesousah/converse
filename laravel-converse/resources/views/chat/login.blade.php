@extends('layouts.app')

@section('content')


    <div id="loginform">
        <form action="" method="post">
            {{ csrf_field() }}
            <p>Please enter your name to continue:</p>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" autofocus />
            <input type="submit" name="enter" id="enter" value="Enter" />
        </form>
    </div>


@endsection