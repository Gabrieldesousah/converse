<form action="{{ url('/contentsInMass') }}" method="POST">

    {{ csrf_field() }}
    
    <select multiple name="content[]">
        @foreach($materials as $m)
        <option value="{{ $m->content }}" selected>{{ $m->content }}</option>
        @endforeach
    </select><br>
    <input type="submit" value="Enviar" >
</form> 