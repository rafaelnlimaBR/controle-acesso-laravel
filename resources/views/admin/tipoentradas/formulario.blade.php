@extends('admin.layout')
@section('conteudo')
<div class="row">
    <div class="col-md-5">
        <!--begin::Different Height-->
        <div class="card shadow card-secondary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">{{$titulo_card}}</div></div>
            <!--end::Header-->
            <!--begin::Body-->
            <form class="needs-validation" novalidate="" method="post" action="{{isset($tipo)?route('tipoPagamento.atualizar',['tipo'=>$tipo]):route('tipoPagamento.cadastrar')}}">
                {{csrf_field()}}
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row g-3">
                        <!--begin::Col-->

                        <div class="col-md-3">
                            <label  class="form-label">Ativo<span class="sr-only"> </span></label>
                            <select  class="form-control" name="ativo" >
                                @if(isset($tipo))
                                    @if($tipo->ativo == '1')
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
                        <div class="col-md-7">
                            <label  class="form-label">Nome<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="nome" value="{{isset($nome)?$nome:old('nome',isset($tipo)?$tipo->nome:'')}}" >
                            @error('nome')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror


                        </div>
                        <div class="col-md-2">
                            <label  class="form-label">Pix<span class="sr-only"> </span></label>
                            <select  class="form-control" name="pix" >
                                @if(isset($tipo))
                                    @if($tipo->pix == '1')
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
                    </div>

                    <!--end::Row-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    @if(isset($tipo))
                        <button class="btn btn-warning" type="submit">Editar</button>
                        @can('grupo-deletar')
                        <a href="{{route('tipoPagamento.excluir',['tipo'=>$tipo])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
                        @endcan
                    @else
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @endif

                    <a href="{{route('tipoPagamento.index')}}" class="btn btn-dark" type="submit">Voltar </a>
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

</div>

@stop
