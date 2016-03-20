<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>TVZskladište :: {{ $page_title or 'Dobrodošli' }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="TVZ, skladište, upravljanje sadržajem, administracija, narudžbe">
    <meta name="description" content="TVZskladište">
    <meta name="author" content="Matija Buriša, Denis Fodor">
    <meta property="og:title" content="TVZskladište" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::url('/') }}" />
    <meta property="og:site_name" content="TVZskladiste.tvz.hr" />
    <meta property="og:description" content="TVZskladište" />

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="canonical" href="{{ Request::url() }}" />

    <!-- scripts -->
    {{ HTML::script('js/jquery.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/modernizr.js', ['charset' => 'utf-8']) }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js', array('charset' => 'utf-8')) }}
    {{ HTML::script('js/respond.min.js', array('charset' => 'utf-8')) }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/main.css') }}
</head>
<body>
    <section class="section main-content img-center text-center" id="main">
        {{ HTML::image('css/assets/images/logo.png', 'Logo', ['title' => 'TVZskladište', 'class' => 'img-responsive']) }}                        
        <h1 class="section-header">Dobrodošli u TVZskladište</h1>

        <a href="{{ URL::route('login') }}">
            <button class="btn btn-primary btn-padded">Prijava</button>
        </a>
    </section> <!-- end main-content -->

        <!-- scripts -->
    {{ HTML::script('js/bootstrap.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/classie.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/init.js', ['charset' => 'utf-8']) }}
</body>
</html>