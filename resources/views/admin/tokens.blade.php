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
                <li>Configuració</li>
                <li class="active">Inicialitzar tokens</li>
            </ul>
            <!-- .breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Inicialitzador de tokens
                </h1>
            </div>
            <!-- /.page-header -->
            <button id="inicialitzartots" class="btn btn-info">Inicialitzar tots</button>
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="table-responsive">
                        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Cognoms</th>
                                <th class="hidden-480">Pagat</th>
                                <th>Username</th>

                                <th class="hidden-480">Correu</th>

                                <th>Accions</th>
                            </tr>
                            </thead>
                            <tbody id="tots">
                            @foreach($usuaris as $u)
                                <tr>
                                    <td id="id">{{$u->usu_id}}</td>
                                    <td>{{$u->usu_nom}}</td>
                                    <td>{{ $u->usu_cognom1 }} {{ $u->usu_cognom2 }}</td>
                                    <td class="hidden-480">
                                        @if($u->est_id == 1)
                                            <span class="label label-sm label-warning">No validat/pagat</span>
                                        @else
                                            <span class="label label-sm label-success">Validat/pagat</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $u->usu_nick }}
                                    </td>
                                    <td class="hidden-480">
                                        {{ $u->usu_correu }}
                                    </td>

                                    <td>
                                        <a style="cursor: pointer" class="green tokenizar">
                                            <i class="icon-pencil bigger-130"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.page-content -->
    </div><!-- /.main-content -->
@endsection