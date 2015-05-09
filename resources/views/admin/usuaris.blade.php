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
                                                        <th class="hidden-480">Token</th>

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
                                                                {{ $u->usu_nom }}
                                                            </td>
                                                            <td>{{ $u->usu_cognom1 }} {{ $u->usu_cognom2 }}</td>
                                                            <td>
                                                                <span class="span5">
                                                                    <label class="pull-right inline">
                                                                        @if($u->est_id == 1)
                                                                        <input id="{{ $u->usu_id }}" type="checkbox" class="ace ace-switch ace-switch-5 canvi" />
                                                                        <span class="lbl"></span>
                                                                        <div id="elec" style="display: none">{{ $u->est_id }}</div>
                                                                        @else
                                                                        <input id="{{ $u->usu_id }}" checked="" type="checkbox" class="ace ace-switch ace-switch-5 canvi" />
                                                                        <span class="lbl"></span>
                                                                        <div id="elec" style="display: none">{{ $u->est_id }}</div>
                                                                        @endif
                                                                    </label>
                                                                </span><!-- /span -->
                                                            </td>

                                                            <td class="hidden-480">
                                                                {{ $u->token }}
                                                            </td>

                                                            <td class="hidden-480">
                                                                {{ $u->usu_correu }}
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
                                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
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