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
            @if(!isset($id))
                <div class="page-header">
                    <h1>
                        Usuaris
                    </h1>
                </div>
                <!-- /.page-header -->
            @endif
            <div class="row">
                <div class="col-xs-iv">
                    <!-- PAGE CONTENT BEGINS -->

                    @if (Session::has('flash_message'))
                        <div class="col-xs-12">
                            <div class="alert alert-info">
                                {!! Session::get('flash_message') !!}
                            </div>
                        </div>
                    @endif

                    @if(isset($id))
                        <h2 class="header blue">
                            Editar Usuari
                        </h2>
                        @if (count($errors) > 0)
                            <div class="col-xs-12">
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        {!! Form::open(array('url' => 'admin/usuaris/editar/' . $id)) !!}

                        <div class="col-xs-12">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="dni">DNI:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-edit"></i></span>
                                        <input type="text" class="form-control input-mask-dni" id="editardni" name="editardni" value="{{ $usuaris->dni }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="nom">Nom:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                                        <input type="text" class="form-control" id="editarnom" name="editarnom" value="{{ $usuaris->name }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="surname1">Primer cognom:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                                        <input type="text" class="form-control" id="editarsurname1" name="editarsurname1" value="{{ $usuaris->surname1 }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="surname2">Segon cognom:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                                        <input type="text" class="form-control" id="editarsurname2" name="editarsurname2" value="{{ $usuaris->surname2 }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="username">Nickname:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-desktop"></i></span>
                                        <input type="text" class="form-control" id="editarusername" name="editarusername" value="{{ $usuaris->username }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="email" class="form-control" id="editaremail" name="email" value="{{ $usuaris->email }}" />
                                        <span id="icono" class="input-group-addon"><i class="icon-unchecked"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="password">Contrasenya:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-edit"></i></span>
                                        <input type="password" class="form-control" id="editarpassword" name="editarpassword" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="password">Repeteix la contrasenya:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-edit"></i></span>
                                        <input type="password" class="form-control" id="editarpassword_confirmation" name="editarpassword_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            {!! Form::submit('Editar', array( 'class' => 'btn btn-info')) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>

                    @else
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
                                                            <td>{{ $u->surname1 }} {{ $u->surname2 }}</td>
                                                            <td>
                                                                <span class="span5">
                                                                    <label class="pull-right inline">
                                                                        @if($u->state_id == 1)
                                                                        <input id="{{ $u->id }}" type="checkbox" class="ace ace-switch ace-switch-5 canvi" />
                                                                        <span class="lbl"></span>
                                                                        <div id="elec" style="display: none">{{ $u->state_id }}</div>
                                                                        @else
                                                                        <input id="{{ $u->id }}" checked="" type="checkbox" class="ace ace-switch ace-switch-5 canvi" />
                                                                        <span class="lbl"></span>
                                                                        <div id="elec" style="display: none">{{  $u->state_id }}</div>
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

                                                                    <a class="green" href="{{ url('admin/usuaris/' . $u->id) }}">
                                                                        <i class="icon-pencil bigger-130"></i>
                                                                    </a>

                                                                    <a id="{{ $u->id }}" class="red" href="#">
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
                                                                                <a href="{{ url('admin/usuaris/' . $u->id) }}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                    <span class="green">
                                                                                        <i class="icon-edit bigger-120"></i>
                                                                                    </span>
                                                                                </a>
                                                                            </li>

                                                                            <li>
                                                                                <a id="{{ $u->id }}" class="tooltip-error" data-rel="tooltip" title="Delete">
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
                                                <label class="control-label" for="surname1">Primer cognom:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                                    <input type="text" class="form-control" id="afegirsurname1" name="afegirsurname1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label" for="surname2">Segon cognom:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                                    <input type="text" class="form-control" id="afegirsurname2" name="afegirsurname2">
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
                    @endif
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.page-content -->
    </div><!-- /.main-content -->
@endsection