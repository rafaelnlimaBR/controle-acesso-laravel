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
            <form class="needs-validation" novalidate="" method="post" action="{{isset($modelo)?route('modelo.atualizar',['modelo'=>$modelo]):route('modelo.cadastrar')}}">
                {{csrf_field()}}
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-8">
                            <label  class="form-label">Nome<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="nome" value="{{isset($nome)?$nome:old('nome',isset($modelo)?$modelo->nome:'')}}" >
                            @error('nome')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror


                        </div>
                        <div class="col-md-4">
                            <label  class="form-label">Montadoras<span class="sr-only"> </span></label>
                            <select class="form-control" name="montadora" id="montadora-select2">
                                @foreach($montadoras as $montadora)
                                    @if(isset($modelo))
                                        @if($montadora->id == $modelo->montadora->id)
                                            <option selected value="{{$montadora->id}}">{{$montadora->nome}}</option>
                                        @else
                                            <option  value="{{$montadora->id}}">{{$montadora->nome}}</option>
                                        @endif
                                    @else
                                        <option  value="{{$montadora->id}}">{{$montadora->nome}}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('montadora')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror


                        </div>

                    </div>

                    <!--end::Row-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    @if(isset($modelo))
                        <button class="btn btn-warning" type="submit">Editar</button>
                        @can('modelo-deletar')
                        <a href="{{route('modelo.excluir',['modelo'=>$modelo])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
                        @endcan
                    @else
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @endif

                    <a href="{{route('modelo.index')}}" class="btn btn-dark" type="submit">Voltar </a>
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
