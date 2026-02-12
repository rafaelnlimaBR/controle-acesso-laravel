@extends('admin.layout')
@section('conteudo')
<div class="row">
    <div class="col-md-6">
        <!--begin::Different Height-->
        <div class="card card-secondary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">{{$titulo_card}}</div></div>
            <!--end::Header-->
            <!--begin::Body-->
            <form enctype="multipart/form-data" class="needs-validation" novalidate="" method="post" action="{{isset($usuario)?route('usuario.atualizar',['usuario'=>$usuario]):route('usuario.cadastrar')}}">
                <div class="card-body">
            @include('admin.usuarios.includes.form')
                </div>
                <div class="card-footer">
                    @if(isset($usuario))
                        @if($usuario->editavel)
                            <button class="btn btn-warning" type="submit">Editar</button>
                        @endif

                        @can('usuario-deletar')
                            @if($usuario->deletavel == 1)
                                <a href="{{route('usuario.excluir',['usuario'=>$usuario])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
                            @endif
                        @endcan
                    @else
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @endif

                        <a href="{{$route_back}}" class="btn btn-dark" type="submit">Voltar </a>


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
    @if(isset($usuario))
        @include('admin.contatos.formulario',['contatos'=>$usuario->contatos,'route_form'=>route('usuario.adicionar.contato',['usuario'=>$usuario]),'route_delete'=>route('usuario.remover.contato',['usuario'=>$usuario])])
    @endif
</div>

@stop
