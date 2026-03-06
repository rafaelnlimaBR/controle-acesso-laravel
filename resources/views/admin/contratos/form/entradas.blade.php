@extends('admin.layout')
@section('conteudo')

    @include('admin.entradas.includes.form',['route_form'=>route('contrato.pagamento.gravar',['contrato'=>$contrato,'historico'=>$historico_selecionado])])

@endsection
