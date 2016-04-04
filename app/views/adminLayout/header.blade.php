<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="hr" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>    <html lang="hr" class="no-js lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="hr" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>TVZskladište :: {{ $page_title or 'Administracija' }}</title>
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
    {{ HTML::script('js/bootstrap.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/modernizr.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/classie.min.js', ['charset' => 'utf-8']) }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/respond.min.js', ['charset' => 'utf-8']) }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/main.css') }}
</head>
<body>

<!-- notifications -->
<div class="notificationOutput" id="outputMsg">
    <div class="notificationTools" id="notifTool">
        <span class="fa fa-times fa-med" id="notificationRemove"></span>
        <span id="notificationTimer"></span>
    </div>
</div>

<section class="content">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <span class="navbar-brand">TVZSkladište</span>
            </div>
            <ul class="nav navbar-nav">
                {{ HTML::smartRoute_link('admin/pocetna', 'Početna', '<i class="fa fa-home"></i>') }}
                {{ HTML::smartRoute_link('admin/proizvodi', 'Proizvodi', '<i class="fa fa-list"></i>') }}
                {{ HTML::smartRoute_link('admin/moje-narudzbe', 'Moje narudžbe', '<i class="fa fa-shopping-cart"></i>') }}
                @if(Auth::user()->group->id >= 2) {{ HTML::smartRoute_link('admin/kategorije', 'Kategorije', '<i class="fa fa-database"></i>') }} @endif
                @if(Auth::user()->group->id >= 2) {{ HTML::smartRoute_link('admin/narudzbe', 'Narudžbe', '<i class="fa fa-shopping-cart"></i>') }} @endif
                @if(Auth::user()->group->id >= 3) {{ HTML::smartRoute_link('admin/stanje', 'Stanje', '<i class="fa fa-line-chart"></i>') }} @endif
                @if(Auth::user()->group->id >= 4) {{ HTML::smartRoute_link('admin/korisnici', 'Korisnici', '<i class="fa fa-users"></i>') }} @endif
            </ul>
        </div>
    </nav>

    <div class="user-info">
        <span class="pull-left">
            Dobrodošao nazad <b>{{ Auth::user()->username }}</b> (<i>{{ Auth::user()->group->group_name }}</i>)
        </span>
        <span class="pull-right">
            <a href="{{ url('logout') }}">
                <button class="btn btn-primary">Odjava <i class="fa fa-sign-out"></i></button>
            </a>
        </span>
    </div>