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
            <form class="needs-validation" novalidate="" method="post" action="{{isset($grupo)?route('grupo.atualizar',['grupo'=>$grupo]):route('grupo.cadastrar')}}">
                {{csrf_field()}}
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-12">
                            <label  class="form-label">Nome<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="nome" value="{{isset($nome)?$nome:old('nome',isset($grupo)?$grupo->nome:'')}}" >
                            @error('nome')
                            <div class="invalid-feedback">{{@$message}}</div>
                            @enderror


                        </div>

                        <div class="col-md-12">

                            <label for="inputEmail4">Permissões</label>
                            <select class="form-control mult-select" name="permissoes[]" multiple>


                                @foreach($permissoes as $permissao)
                                    //fazer um selected com if

                                    <option {{isset($grupo)?$grupo->permissoes->contains('id',$permissao->id)?'selected':'':''}} value="{{$permissao->id}}">{{$permissao->nome}}</option>



                                @endforeach
                            </select>
                            <a class="btn btn-sm btn-primary " style="color: #eeeeee; margin: 5px"  id="selecionar-tudo-multi" onclick="">Selecionar Tudo</a>
                            <a class="btn btn-sm btn-warning " style="color: #eeeeee; margin: 5px"  id="deselecionar-tudo-multi" onclick="">Deselecionar Tudo</a>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->



                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    @if(isset($grupo))
                        <button class="btn btn-warning" type="submit">Editar</button>
                        @can('grupo-deletar')
                        <a href="{{route('grupo.excluir',['grupo'=>$grupo])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
                        @endcan
                    @else
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @endif

                    <a href="{{route('grupo.index')}}" class="btn btn-dark" type="submit">Voltar </a>
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
