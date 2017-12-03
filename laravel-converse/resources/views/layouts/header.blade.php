<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Provas e conteúdos universitários que vão salvar seu semestre">
    <meta name="author" content="SeuMérito.com">
    <!-- favicon -->
    <link rel="shortcut icon" href="<--?php echo PATH_STYLE; ?>assets/img/logo.png" type="image/x-icon"/>

    <meta property="og:locale" content="pt_BR">
    <meta property="og:url" content="seumerito.com">
     
    <meta property="og:title" content="Seu Mérito - Provas Universitárias">
    <meta property="og:site_name" content="Seu Mérito - Provas Universitárias">
     
    <meta property="og:description" content="Prova nessa semana e já não sabe o que fazer? Aprenda o que vai cair na sua prova de forma dirigida e rápida,  garanta seu 10!">
     
    <meta property="og:image" content="<--?php echo URL.ROOT;?-->sm-bann.jpg">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="600">

    <meta property="og:type" content="website">
    <!--/** CASO SEJA UM ARTIGO **/-->
    <!--<meta property="og:type" content="article"> <meta property="article:author" content="Autor do artigo"> <meta property="article:section" content="Seção do artigo"> <meta property="article:tag" content="Tags do artigo"> <meta property="article:published_time" content="14/06/2015"> -->


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('libs/ckeditor/ckeditor.js') }}"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">



    <!-- Scripts -->
    <script>
    window.onload = function() {
        CKEDITOR.replace( 'body' );
    };
</script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>