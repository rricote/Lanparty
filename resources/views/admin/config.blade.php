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
                    Configuració del sistema
                </h1>
            </div>
            <!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="col-xs-12">
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

                        {!! Form::open(array('url' => 'admin/config/editar')) !!}

                        <div class="col-xs-12">

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('patrocinador', 'Patrocinador:', null, array('class' => 'control-label')) !!}
                                    {!! Form::select('patrocinador', $edicions, $config['edicio'], array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('data', 'Data d\'inici de la edició', null, array('class' => 'control-label')) !!}
                                    <div class="input-group">
                                        {!! Form::text('datepicker', $config['date'], array('id' => 'datepicker', 'type' => 'text', 'required', 'data-date-format' => 'dd-mm-yyyy', 'class' => 'form-control date-picker')) !!}
                                        <span class="input-group-addon">
                                            <i class="icon-calendar bigger-110"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('hora', 'Hora d\'inici de la edició', null, array('class' => 'control-label')) !!}
                                    <div class="input-group bootstrap-timepicker">
                                        {!! Form::text('timepicker', $config['time'], array('id' => 'timepicker', 'type' => 'text', 'required',  'class' => 'form-control')) !!}
                                        <span class="input-group-addon">
                                            <i class="icon-time bigger-110"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    {!! Form::label('email', 'E-mail de contacte:', null, array('class' => 'control-label')) !!}
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        {!! Form::email('email', $config['email'], array('required', 'class' => 'form-control', 'placeholder' => 'E-mail')) !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div>
                            {!! Form::submit('Modificar', array( 'class' => 'btn btn-info')) !!}
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