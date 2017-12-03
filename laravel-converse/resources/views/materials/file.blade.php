@extends('layouts.app')

@section('content')
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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $type }} de {{ $material->content }}</div>
                <div class="panel-body">
                <embed src="{{ url($file_path) }}" width="100%" height="600px"></embed>
                    <!--iframe src="{{ url($file_path) }}" width="100%" height="600px"-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



