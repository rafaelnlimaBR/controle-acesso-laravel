@extends('admin.layout')
@section('conteudo')
<div class="row">
    <div class="col-md-2">
        <!--begin::Different Height-->
        <div class="card card-secondary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">{{$titulo_card}}</div></div>
            <!--end::Header-->
            <!--begin::Body-->
            <form class="needs-validation" novalidate="" method="post" action="{{route('usuario.cadastrar.nova.senha')}}">
                {{csrf_field()}}
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row g-3">
                        <!--begin::Col-->

                        <div class="col-md-12">
                            <label  class="form-label">Nova Senha<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="senha" value="{{isset($senha)?$senha:old('senha')}}" >
                            @error('senha')
                            <div class="invalid-feedback">{{@$message}}</div>
                            @enderror
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->

                    </div>

                    <!--end::Row-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    @if(isset($usuario))
                        <button class="btn btn-warning" type="submit">Editar</button>
                    @can('usuario-deletar')
                        <a href="{{route('usuario.excluir',['usuario'=>$usuario])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
                    @endcan
                    @else
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @endif

                    <a href="{{route('usuario.index')}}" class="btn btn-dark" type="submit">Voltar </a>
                </div>
                <!--end::Footer-->
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
