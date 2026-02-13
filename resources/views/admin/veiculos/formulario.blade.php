@extends('admin.layout')
@section('conteudo')
<div class="row">
    <div class="col-md-5">
        <!--begin::Different Height-->
        <div class="card card-secondary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">{{$titulo_card}}</div></div>
            <!--end::Header-->
            <!--begin::Body-->

            <form class="needs-validation" novalidate="" method="post" action="{{isset($veiculo)?route('veiculo.atualizar',['veiculo'=>$veiculo]):route('veiculo.cadastrar')}}">
                <div class="card-body">
                    @include('admin.veiculos.includes.form')
                </div>
                <div class="card-footer">
                    @if(isset($veiculo))
                        <button class="btn btn-warning" type="submit">Editar</button>
                        @can('veiculo-deletar')
                            <a href="{{route('veiculo.excluir',['veiculo'=>$veiculo])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
                        @endcan
                    @else
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @endif

                    <a href="{{route('veiculo.index')}}" class="btn btn-dark" type="submit">Voltar </a>
                </div>
            </form>
            <!--end::Body-->
        </div>
        <!--end::Different Height-->
        <!--begin::Different Width-->

        <!--end::Different Width-->
        <!--begin::Form Validation-->
        <!--end::Form Validation-->
    </div>

</div>

@stop
