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
            @include('admin.usuarios.includes.form')
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
