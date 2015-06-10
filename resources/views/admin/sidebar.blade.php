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
        <li @if ($menu == 'index')class="active"@endif>
            <a href="{{ url('/admin') }}">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>

        <li @if ($menu == 'usuaris')class="active"@endif>
            <a href="{{ url('/admin/usuaris') }}">
                <i class="icon-group"></i>
                <span class="menu-text"> Usuaris </span>
            </a>
        </li>

        <li @if ($menu == 'competicions')class="active"@endif>
            <a href="{{ url('/admin/competicions') }}">
                <i class="icon-group"></i>
                <span class="menu-text"> Competicions </span>
            </a>
        </li>

        <li @if ($menu == 'edicions')class="active"@endif>
            <a href="{{ url('/admin/edicions') }}">
                <i class="icon-group"></i>
                <span class="menu-text"> Edicions </span>
            </a>
        </li>

        <li @if ($menu == 'estats')class="active"@endif>
            <a href="{{ url('/admin/estats') }}">
                <i class="icon-group"></i>
                <span class="menu-text"> Estats </span>
            </a>
        </li>

        <li @if ($menu == 'grups')class="active"@endif>
            <a href="{{ url('/admin/grups') }}">
                <i class="icon-group"></i>
                <span class="menu-text"> Grups </span>
            </a>
        </li>

        <li @if ($menu == 'motius')class="active"@endif>
            <a href="{{ url('/admin/motius') }}">
                <i class="icon-group"></i>
                <span class="menu-text"> Motius </span>
            </a>
        </li>

        <li @if ($menu == 'patrocinadors')class="active"@endif>
            <a href="{{ url('/admin/patrocinadors') }}">
                <i class="icon-group"></i>
                <span class="menu-text"> Patrocinadors </span>
            </a>
        </li>

        <li @if ($menu == 'premis')class="active"@endif>
            <a href="{{ url('/admin/premis') }}">
                <i class="icon-group"></i>
                <span class="menu-text"> Premis </span>
            </a>
        </li>

        <li @if ($menu == 'rols')class="active"@endif>
            <a href="{{ url('/admin/rols') }}">
                <i class="icon-group"></i>
                <span class="menu-text"> Rols </span>
            </a>
        </li>

        <li @if ($menu == 'assignacions')class="active"@endif>
            <a href="{{ url('/admin/assignacions') }}">
                <i class="icon-group"></i>
                <span class="menu-text"> Assignacions </span>
            </a>
        </li>

        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-cog"></i>
                <span class="menu-text"> Configuració </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu" @if ($menu == 'tokens' || $menu == 'config' || $menu == 'assistencies')style="display: block;"@endif>
                <li @if ($menu == 'assistencies')class="active"@endif>
                    <a href="{{ url('/admin/assistencies') }}">
                        <i class="icon-double-angle-right"></i>
                        Calculador de numeros
                    </a>
                </li>
                <li @if ($menu == 'config')class="active"@endif>
                    <a href="{{ url('/admin/config') }}">
                        <i class="icon-double-angle-right"></i>
                        Configuració del sistema
                    </a>
                </li>
                <li @if ($menu == 'tokens')class="active"@endif>
                    <a href="{{ url('/admin/tokens') }}">
                        <i class="icon-double-angle-right"></i>
                        Reinicialitzador de tokens
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

            <ul class="submenu" @if ($menu == 'sorteig')style="display: block;"@endif>
                <li @if ($menu == 'entrada')class="active"@endif>
                    <a href="{{ url('/admin/app/assistencies/entrada') }}">
                        <i class="icon-double-angle-right"></i>
                        Control entrada
                    </a>
                </li>
                {{--<li @if ($menu == 'sorteig')class="active"@endif>--}}
                    {{--<a href="{{ url('/admin/app/sorteig') }}">--}}
                        {{--<i class="icon-double-angle-right"></i>--}}
                        {{--Sortejador--}}
                    {{--</a>--}}
                {{--</li>--}}
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