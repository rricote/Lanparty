<!DOCTYPE html>
<html>
<head>
    <!-- ==========================
    	Meta Tags
    =========================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">

    <!-- ==========================
    	Title
    =========================== -->
    <title>Lanparty</title>
    <!-- ==========================
    	CSS
    =========================== -->
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/owl.carousel.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/owl.theme.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/owl.transitions.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/creative-brands.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/jquery.vegas.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/magnific-popup.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- ==========================
        Fonts
    =========================== -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- ==========================
    	JS
    =========================== -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <h1>Lanparty</h1>
    <!-- ==========================
        HEADER - START
    =========================== -->
    <header class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand visible-xs">Lanparty</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">Pagina inicial</a></li>
                    <li><a href="#">Institut de l'ebre</a></li>
                    <li><a href="#">Streaming de la LAN Party</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Edició 2015</a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-plus"></i>Programa</a></li>
                            <li><a href="#"><i class="fa fa-plus"></i>Competicions</a></li>
                            <li><a href="#"><i class="fa fa-plus"></i>Col·laboradors</a></li>
                            <li><a href="#"><i class="fa fa-plus"></i>Premis</a></li>
                            <li><a href="#"><i class="fa fa-plus"></i>Cartell</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Contacta</a></li>
                </ul>
                <div class="pull-right navbar-buttons hidden-xs">
                @if (Auth::guest())
                    <a style="margin:10px" href="{{ url('/auth/register') }}" class="btn btn-primary">Registar-se</a>
                    <a style="margin:10px" href="{{ url('/auth/login') }}" class="btn btn-inverse">Entrar</a>
                @else
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                    </ul>
                @endif
                </div>
            </div>
        </div>
    </header>
    <!-- ==========================
    	HEADER - END
    =========================== -->

    <!-- ==========================
    	TITLE - START
    =========================== -->
    <div class="container hidden-xs">
        <div class="header-title">
            <div class="pull-left">
                <h2><a href="#"><span class="text-primary">LAN</span> Party</a></h2>
                <p>Institut de l'ebre 15-14 de maig de 2015</p>
            </div>
        </div>
    </div>
    <!-- ==========================
    	TITLE - END
    =========================== -->

    <!-- ==========================
    	CONTENT - START
    =========================== -->
	@yield('content')
    <!-- ==========================
    	CONTENT - END
    =========================== -->

    <!-- ==========================
         FOOTER - START
     =========================== -->
    <div class="container">
        <footer class="navbar navbar-default">
            <div class="row">
                <div class="col-md-6 hidden-xs hidden-sm">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Pagina inicial</a></li>
                        <li><a href="#">Institut de l'ebre</a></li>
                        <li><a href="#">Streaming de la LAN Party</a></li>
                        <li><a href="#">Contacta</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <p class="copyright">© Lanparty 2014 - 2015 All rights reserved. Programed by <a href="#" target="_blank">Rafael Ricote.</a>, designed by Pixelized Studio.</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- ==========================
    	FOOTER - END
    =========================== -->

    <!-- ==========================
         JS
     =========================== -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/js/creative-brands.js') }}"></script>
    <script src="{{ asset('/js/jquery.vegas.min.js') }}"></script>
    <script src="{{ asset('/js/twitterFetcher_min.js') }}"></script>
    <script src="{{ asset('/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('/js/custom.js') }}"></script>
</body>
</html>
