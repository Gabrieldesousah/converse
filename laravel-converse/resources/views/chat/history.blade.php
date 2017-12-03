@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <table>
            <tr>
                <td>user</td>
                <td>message</td>
                <td>created at</td>
            </tr>
            
        @foreach($messages as $message)
            <tr>
                <td>{{ $message->user_id }}</td>
                <td>{{ $message->message }}</td>
                <td>{{ $message->created_at }}</td>
            </tr>
        @endforeach
        
        </table>
    </div>
</div>
@endsection

