@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
        <div class="col-lg-4">
            <div class="box-option">
                <div class="box-top">
                    <div class="box-header">
                        <span class="box-title">{{ $type }} de {{ $material->content }}
                            <span class="box-info"><br>{{ $material->professor }}</span>
                        </span>
                        
                    </div>
                </div>
                <a href="{{ url('/material') }}/{{ $material->id }}" class="box-signup">Ver mais</a>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
@endsection



