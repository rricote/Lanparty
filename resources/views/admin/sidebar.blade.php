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