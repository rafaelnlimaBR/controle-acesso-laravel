@extends('admin.layout')
@section('conteudo')
<div class="row">
    <div class="col-md-3">
        <!--begin::Different Height-->
        <div class="card card-secondary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">{{$titulo_card}}</div></div>
            <!--end::Header-->
            <!--begin::Body-->
            <form class="needs-validation" novalidate="" method="post" action="{{isset($categoria)?route('categoria.atualizar',['categoria'=>$categoria]):route('categoria.cadastrar')}}">
                {{csrf_field()}}
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label  class="form-label">Ativo<span class="sr-only"> </span></label>
                            <select  class="form-control" name="ativo" >
                                @if(isset($grupo))
                                    @if($grupo->ativo == '1')
                                        <option value="1" selected> Sim</option>
                                        <option value="0" > Não</option>
                                    @else
                                        <option value="1" > Sim</option>
                                        <option value="0" selected> Não</option>
                                    @endif
                                @else
                                    <option value="1" > Sim</option>
                                    <option value="0" > Não</option>
                                @endif
                            </select>

                        </div>
                        <!--begin::Col-->
                        <div class="col-md-9">
                            <label  class="form-label">Nome<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="nome" value="{{isset($nome)?$nome:old('nome',isset($categoria)?$categoria->nome:'')}}" >
                            @error('nome')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror


                        </div>

                    </div>
                    <div class="row ">


                        <!--begin::Col-->
                        <div class="col-md-12">
                            <label  class="form-label">Link<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="link" value="{{isset($link)?$link:old('link',isset($categoria)?$categoria->nome_link:'')}}" >
                            @error('link')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror


                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label  class="form-label">Descrição<span class="sr-only"> </span></label>
                            <textarea class="form-control" name="descricao">{{isset($descricao)?$descricao:old('descricao',isset($categoria)?$categoria->meta_descricao:'')}}</textarea>
                            @error('descricao')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label  class="form-label">Keywords<span class="sr-only"> </span></label>
                            <textarea class="form-control" name="keywords">{{isset($keywords)?$keywords:old('keywords',isset($categoria)?$categoria->meta_keywords:'')}}</textarea>
                            @error('keywords')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>


                    <!--end::Row-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    @if(isset($categoria))
                        <button class="btn btn-warning" type="submit">Editar</button>
                        @can('categoria-deletar')
                        <a href="{{route('categoria.excluir',['categoria'=>$categoria])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
                        @endcan
                    @else
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @endif

                    <a href="{{route('categoria.index')}}" class="btn btn-dark" type="submit">Voltar </a>
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Body-->
        </div>

    </div>

</div>

@stop
