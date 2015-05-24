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
                <li class="active">Competicions</li>
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
                    Competicions
                </h1>
            </div>
            <!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="col-xs-12">
                        <div class="table-header">
                            Llistat de totes les competicions
                        </div>

                        <div class="table-responsive">
                            <table id="taula-competicions" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">
                                        <label>
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </th>
                                    <th>Nom</th>
                                    <th>Integrants grup</th>
                                    <th>Logo</th>
                                    <th class="hidden-480">Edició</th>
                                    <th>Accions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($competicions as $c)
                                    <tr>
                                        <td class="center">
                                            <label>
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </td>

                                        <td>
                                            {{ $c->name }}
                                        </td>


                                        <td>
                                            {{ $c->number }}
                                        </td>

                                        <td>
                                            <img style="max-width: 40px;" src="{{ url('icons/competicions/' . $c->logo) }}" alt="logo{{ $c->name }}">
                                        </td>

                                        <td class="hidden-480">
                                            {{ $c->edicio->name }}
                                        </td>

                                        <td>
                                            <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                                <a class="blue" href="#veure" data-toggle="modal">
                                                    <i class="icon-zoom-in bigger-130"></i>
                                                </a>

                                                <a class="green" href="#editar" data-toggle="modal">
                                                    <i class="icon-pencil bigger-130"></i>
                                                </a>

                                                <a id="{{ $c->id }}" class="red borrar">
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
                                                            <a href="#veure" class="tooltip-info" data-rel="tooltip" title="View" data-toggle="modal">
                                                                <span class="blue">
                                                                    <i class="icon-zoom-in bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#editar" class="tooltip-success" data-rel="tooltip" title="Edit" data-toggle="modal">
                                                                <span class="green">
                                                                    <i class="icon-edit bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a id="{{ $c->id }}" class="tooltip-error borrar" data-rel="tooltip" title="Delete">
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

                    <div class="col-xs-12">
                        <h2 class="header blue">
                            Afegir Competició
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

                        @if (Session::has('flash_message'))
                            <div class="col-xs-12">
                                <div class="alert alert-info">
                                    {!! Session::get('flash_message') !!}
                                </div>
                            </div>
                        @endif

                        {!! Form::open(array('url' => 'admin/competicions/afegir', 'files'=>true)) !!}

                        <div class="col-xs-12">

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('competicio', 'Nom de la competició:', null, array('class' => 'control-label')) !!}
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-edit"></i></span>
                                        {!! Form::text('name', null, array('required', 'class' => 'form-control', 'placeholder' => 'Nom')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('arxiu', 'Nom de la competició:', null, array('class' => 'control-label')) !!}
                                    {!! Form::file('image', array('id' => 'input-image')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('competicio', 'Integrants per grup: (En cas de ser individual deixar a 1)', null, array('class' => 'control-label')) !!}
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-ellipsis-vertical"></i></span>
                                        {!! Form::number('number', '1', array('class' => 'form-control', 'min' => '1', 'max' => '10', 'step' => '1')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            {!! Form::submit('Afegir', array( 'class' => 'btn btn-info')) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.page-content -->
    </div><!-- /.main-content -->
@endsection