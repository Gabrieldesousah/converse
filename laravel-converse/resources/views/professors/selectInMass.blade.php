<form action="{{ url('/professorsInMass') }}" method="POST">

    {{ csrf_field() }}
    
    <select multiple name="professors[]">
        @foreach($professors as $p)
        <option value="{{ $p->professor }}" selected>{{ $p->professor }}</option>
        @endforeach
    </select><br>
    <input type="submit" value="Enviar" >
</form> 