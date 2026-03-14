@extends('admin.layout')

@section('conteudo')
    @if(isset($contrato))

    <div class="row botoes" style="margin-bottom: 15px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <a class="btn btn-primary"  href="{{route('contrato.baixar.contrato.pdf',['contrato'=>$contrato])}}">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Baixar Ordem em PDF
                    </a>

                    <a class="btn btn-primary"  href="{{route('contrato.baixar.historico.pdf',['contrato'=>$contrato])}}">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Baixar Historico em PDF
                    </a>
                    @if($contrato->historicos->map->entradas->flatten()->count() >= 1)
                        <a class="btn btn-primary"  href="{{route('contrato.baixar.recibo.pdf',['contrato'=>$contrato])}}">
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Baixar Recibo em PDF
                        </a>
                    @endif

                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
    @endif
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
                            <li class="nav-item">
                                <a class="nav-link {{request()->has('pagina')?request()->get('pagina')=='servicos'?'active':'':''}}"
                                   id="custom-tabs-three-messages-tab" data-toggle="pill" href="#servicos" role="tab"
                                   aria-controls="custom-tabs-three-messages" aria-selected="false">Serviços</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{request()->has('pagina')?request()->get('pagina')=='pecasavulsas'?'active':'':''}}"
                                   id="custom-tabs-three-messages-tab" data-toggle="pill" href="#pecasavulsas" role="tab"
                                   aria-controls="custom-tabs-three-messages" aria-selected="false">Peças Avulsas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{request()->has('pagina')?request()->get('pagina')=='pagamentos'?'active':'':''}}"
                                   id="custom-tabs-three-messages-tab" data-toggle="pill" href="#pagamentos" role="tab"
                                   aria-controls="custom-tabs-three-messages" aria-selected="false">Pagamentos</a>
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
                            <div
                                class="tab-pane {{request()->has('pagina')?request()->get('pagina')=='servicos'?'active':'':''}}"
                                id="servicos" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                @include('admin.contratos.includes.servicos')
                            </div>
                            <div
                                class="tab-pane {{request()->has('pagina')?request()->get('pagina')=='pecasavulsas'?'active':'':''}}"
                                id="pecasavulsas" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                @include('admin.contratos.includes.pecas-avulsas')
                            </div>
                            <div
                                class="tab-pane {{request()->has('pagina')?request()->get('pagina')=='pagamentos'?'active':'':''}}"
                                id="pagamentos" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                @include('admin.contratos.includes.pagamentos')
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div>

    </div>

    @include('admin.usuarios.formulario-modal')
    @include('admin.veiculos.formulario-modal')
@endsection
