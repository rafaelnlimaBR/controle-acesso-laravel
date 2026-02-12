@extends('admin.layout')

@section('conteudo')

    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-dark card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{request()->has('pagina')?request()->get('pagina')=='dados'?'active':'':'active'}}"
                               id="custom-tabs-three-home-tab" data-toggle="pill" href="#dados" role="tab"
                               aria-controls="custom-tabs-three-home" aria-selected="false">Dados</a>
                        </li>
                        @if(isset($contrato))
                            <li class="nav-item">
                                <a class="nav-link {{request()->has('pagina')?request()->get('pagina')=='historicos'?'active':'':''}}"
                                   id="custom-tabs-three-profile-tab" data-toggle="pill" href="#historicos" role="tab"
                                   aria-controls="custom-tabs-three-profile" aria-selected="false">Historicos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{request()->has('pagina')?request()->get('pagina')=='registros'?'active':'':''}}"
                                   id="custom-tabs-three-messages-tab" data-toggle="pill" href="#registros" role="tab"
                                   aria-controls="custom-tabs-three-messages" aria-selected="false">Registros</a>
                            </li>
                        @endif

                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div
                            class="tab-pane {{request()->has('pagina')?request()->get('pagina')=='dados'?'active show':'':'active show'}}"
                            id="dados" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                            @include('admin.contratos.includes.dados')

                        </div>
                        @if(isset($contrato))
                            <div
                                class="tab-pane {{request()->has('pagina')?request()->get('pagina')=='historicos'?'active':'':''}}"
                                id="historicos" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                @include('admin.contratos.includes.historico')
                            </div>
                            <div
                                class="tab-pane {{request()->has('pagina')?request()->get('pagina')=='registros'?'active':'':''}}"
                                id="registros" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                @include('admin.contratos.includes.registros')
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div>

    </div>

    @include('admin.usuarios.formulario-modal')
@endsection
