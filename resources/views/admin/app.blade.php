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
    	Favicons
    =========================== -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/icons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/icons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/icons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/icons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/icons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/icons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/icons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/icons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/icons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('/icons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/icons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/icons/manifest.json') }}">
    <link rel="shortcut icon" href="{{ asset('/icons/favicon.ico') }}">

    <!-- ==========================
    	CSS
    =========================== -->
    <link href="{{ asset('/css/admin/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('css/prettify.css')}}" />
    <!-- fonts -->
    <link rel="stylesheet" href="{{ asset('css/ace-fonts.css')}}" />
    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('css/ace.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/ace-rtl.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/ace-skins.min.css')}}" />
    <!-- ==========================
    	JS
    =========================== -->
    <script src="{{ asset('js/ace-extra.min.js')}}"></script>

</head>
<body class="skin-1">
<!-- ==========================
    HEADER - START
=========================== -->
<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small>
                    <i class="icon-leaf"></i>
                    Ace Admin
                </small>
            </a><!-- /.brand -->
        </div><!-- /.navbar-header -->

        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info">
									{{ Auth::user()->name }}
								</span>

                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="icon-cog"></i>
                                Configuració
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-user"></i>
                                Perfil
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="{{ url('/auth/logout') }}">
                                <i class="icon-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.ace-nav -->
        </div><!-- /.navbar-header -->
    </div><!-- /.container -->
</div>
<!-- ==========================
    HEADER - END
=========================== -->
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>
@yield('content')

    </div><!-- /.main-container-inner -->

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="icon-double-angle-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- ==========================
     JS
 =========================== -->
<script>
    var url = '{{asset('/')}}';
</script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='{{ asset('js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
</script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/typeahead-bs2.min.js') }}"></script>

<!-- page specific plugin scripts -->

<script src="{{ asset('js/prettify.js') }}"></script>

<!-- ace scripts -->

<script src="{{ asset('js/ace-elements.min.js') }}"></script>
<script src="{{ asset('js/ace.min.js') }}"></script>

<!-- inline scripts related to this page -->

<script type="text/javascript">
    jQuery(function($) {

        window.prettyPrint && prettyPrint();
        $('#id-check-horizontal').removeAttr('checked').on('click', function(){
            $('#dt-list-1').toggleClass('dl-horizontal').prev().html(this.checked ? '&lt;dl class="dl-horizontal"&gt;' : '&lt;dl&gt;');
        });

    })
</script>
</body>
</html>
