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
            <form enctype="multipart/form-data"  class="needs-validation" novalidate="" method="post" action="{{isset($banner)?route('banner.atualizar',['banner'=>$banner]):route('banner.cadastrar')}}">
                {{csrf_field()}}
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row g-3">
                        <!--begin::Col-->
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
                        <div class="col-md-9">
                            <label  class="form-label">Titulo<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="titulo_banner" value="{{isset($titulo_banner)?$titulo_banner:old('titulo_banner',isset($banner)?$banner->titulo:'')}}" >
                            @error('titulo_banner')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror


                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label  class="form-label">Descricao<span class="sr-only"> </span></label>
                            <textarea class="form-control" name="descricao">{{isset($descricao)?$descricao:old('descricao',isset($banner)?$banner->descricao:'')}}</textarea>

                            @error('descricao')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label  class="form-label">Imagem<span class="sr-only"> </span></label>

                            <input type="file" name="imagem" class="form-control">
                            @error('imagem')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror


                        </div>
                    </div>

                    <!--end::Row-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    @if(isset($banner))
                        <button class="btn btn-warning" type="submit">Editar</button>
                        @can('banner-deletar')
                        <a href="{{route('banner.excluir',['banner'=>$banner])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
                        @endcan
                    @else
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @endif

                    <a href="{{route('banner.index')}}" class="btn btn-dark" type="submit">Voltar </a>
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
    @if(isset($banner))
        <div class="col-md-6">
            <img style="height: 250px" class="image"  src="{{url('/images/banners/'.$banner->imagem)}}">
        </div>

    @endif


</div>

@stop
