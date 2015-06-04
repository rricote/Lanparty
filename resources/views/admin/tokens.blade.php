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
                <li class="active">Reiniciar tokens</li>
            </ul>
            <!-- .breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    Reinicialitzador de tokens
                </h1>
            </div>

            <!-- /.page-header -->
            <button id="inicialitzartots" class="btn btn-info">Reiniciar tots</button>
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
                                    <td id="id">{{$u->id}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>{{ $u->cognom1 }} {{ $u->cognom2 }}</td>
                                    <td class="hidden-480">
                                        @if($u->estat_id == 1)
                                            <span class="label label-sm label-warning">No validat/pagat</span>
                                        @else
                                            <span class="label label-sm label-success">Validat/pagat</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $u->username }}
                                    </td>
                                    <td class="hidden-480">
                                        {{ $u->email }}
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