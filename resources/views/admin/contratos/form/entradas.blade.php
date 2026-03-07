@extends('admin.layout')
@section('conteudo')

    @include('admin.entradas.includes.form',['route_form'=>isset($entrada)?route('contrato.pagamento.atualizar',['contrato'=>$contrato,'historico'=>$historico_selecionado,'pagamento'=>$entrada]):route('contrato.pagamento.gravar',['contrato'=>$contrato,'historico'=>$historico_selecionado])])

@endsection
