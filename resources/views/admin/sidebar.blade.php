@extends('admin.app')

@section('content')
<!-- ==========================
    CONTENT - START
=========================== -->
<div class="sidebar sidebar-fixed" id="sidebar">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

    <ul class="nav nav-list">
        <li>
            <a href="{{ url('/admin') }}">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>

        <li class="active">
            <a href="{{ url('/admin/usuaris') }}">
                <i class="icon-group"></i>
                <span class="menu-text"> Usuaris </span>
            </a>
        </li>

        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-cog"></i>
                <span class="menu-text"> Configuració </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ url('/admin/tokens') }}">
                        <i class="icon-double-angle-right"></i>
                        Inicialitzar tokens
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-cog"></i>
                <span class="menu-desktop"> Aplicatius </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ url('/admin/app/assistencies/entrada') }}">
                        <i class="icon-double-angle-right"></i>
                        Control entrada
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/app/sorteig') }}">
                        <i class="icon-double-angle-right"></i>
                        Sortejador
                    </a>
                </li>
            </ul>
        </li>
    </ul><!-- /.nav-list -->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
    </div>

    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>

@yield('side')

<!-- ==========================
    CONTENT - END
=========================== -->
@endsection