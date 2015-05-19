@extends('admin.sidebar')

@section('side')

    <div class="main-content">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try {
                    ace.settings.check('breadcrumbs', 'fixed')
                } catch (e) {
                }
            </script>

            <ul class="breadcrumb">
                <li>
                    <i class="icon-home home-icon"></i>
                    <a href="{{ url('/admin') }}">Home</a>
                </li>
                <li class="active">Usuaris</li>
            </ul>
            <!-- .breadcrumb -->
            <!--
            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input"
                               id="nav-search-input" autocomplete="off"/>
                        <i class="icon-search nav-search-icon"></i>
                    </span>
                </form>
            </div>
            -->
            <!-- #nav-search -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Usuaris
                </h1>
            </div>
            <!-- /.page-header -->
            <div class="row">
                <div class="col-xs-iv>
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="col-xs-12 col-lg-offset-2 col-lg-8">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#llusuaris">Usuaris</a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#afusuari">Afegir Usuari</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="llusuaris" class="tab-pane in active">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-header">
                                                Llistat de tots els usuaris
                                            </div>

                                            <div class="table-responsive">
                                                <table id="taula-usuaris" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">
                                                            <label>
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </th>
                                                        <th>Nom</th>
                                                        <th>Cognoms</th>
                                                        <th>
                                                            Pagat
                                                        </th>
                                                        <th class="hidden-480">Username</th>

                                                        <th class="hidden-480">Correu</th>

                                                        <th>Accions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($usuaris as $u)
                                                        <tr>
                                                            <td class="center">
                                                                <label>
                                                                    <input type="checkbox" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>

                                                            <td>
                                                                {{ $u->name }}
                                                            </td>
                                                            <td>{{ $u->cognom1 }} {{ $u->cognom2 }}</td>
                                                            <td>
                                                                <span class="span5">
                                                                    <label class="pull-right inline">
                                                                        @if($u->estat_id == 1)
                                                                        <input id="{{ $u->id }}" type="checkbox" class="ace ace-switch ace-switch-5 canvi" />
                                                                        <span class="lbl"></span>
                                                                        <div id="elec" style="display: none">{{ $u->estat_id }}</div>
                                                                        @else
                                                                        <input id="{{ $u->id }}" checked="" type="checkbox" class="ace ace-switch ace-switch-5 canvi" />
                                                                        <span class="lbl"></span>
                                                                        <div id="elec" style="display: none">{{  $u->estat_id }}</div>
                                                                        @endif
                                                                    </label>
                                                                </span><!-- /span -->
                                                            </td>

                                                            <td class="hidden-480">
                                                                {{ $u->username }}
                                                            </td>

                                                            <td class="hidden-480">
                                                                {{ $u->email }}
                                                                <div style="display:none;">{{ url('user/' . $u->ultratoken) }}</div>
                                                            </td>

                                                            <td>
                                                                <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                                                    <a class="blue" href="#">
                                                                        <i class="icon-zoom-in bigger-130"></i>
                                                                    </a>

                                                                    <a class="green" href="#">
                                                                        <i class="icon-pencil bigger-130"></i>
                                                                    </a>

                                                                    <a class="red" href="#">
                                                                        <i class="icon-trash bigger-130"></i>
                                                                    </a>
                                                                </div>

                                                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                                                    <div class="inline position-relative">
                                                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                                            <i class="icon-caret-down icon-only bigger-120"></i>
                                                                        </button>

                                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                                            <li>
                                                                                <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                    <span class="blue">
                                                                                        <i class="icon-zoom-in bigger-120"></i>
                                                                                    </span>
                                                                                </a>
                                                                            </li>

                                                                            <li>
                                                                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                    <span class="green">
                                                                                        <i class="icon-edit bigger-120"></i>
                                                                                    </span>
                                                                                </a>
                                                                            </li>

                                                                            <li>
                                                                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                    <span class="red">
                                                                                        <i class="icon-trash bigger-120"></i>
                                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div id="afusuari" class="tab-pane">
                                    <span id="helpBlock" class="help-block">En cas de no tenir dni: Deixar la casella en blanc</span>
                                    <div class="col-xs-12">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label" for="dni">DNI:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-edit"></i></span>
                                                    <input type="text" class="form-control input-mask-dni" id="afegirdni" name="afegirdni">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label" for="nom">Nom:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                                    <input type="text" class="form-control" id="afegirnom" name="afegirenom">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label" for="cognom1">Primer cognom:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                                    <input type="text" class="form-control" id="afegircognom1" name="afegircognom1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label" for="cognom2">Segon cognom:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                                    <input type="text" class="form-control" id="afegircognom2" name="afegircognom2">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label" for="username">Nickname:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-desktop"></i></span>
                                                    <input type="text" class="form-control" id="afegirusername" name="afegirusername">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label" for="email">Email:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">@</span>
                                                    <input type="email" class="form-control" id="afegiremail" name="afegiremail">
                                                    <span id="icono" class="input-group-addon"><i class="icon-unchecked"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label" for="password">Contrasenya:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-edit"></i></span>
                                                    <input type="password" class="form-control" id="afegirpassword" name="afegirpassword">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label" for="password">Repeteix la contrasenya:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-edit"></i></span>
                                                    <input type="password" class="form-control" id="afegirpassword2" name="afegirpassword2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button id="afegirusuari" class="btn btn-info">Afegir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.page-content -->
    </div><!-- /.main-content -->
@endsection