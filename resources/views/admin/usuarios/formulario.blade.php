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
                {{csrf_field()}}
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-2">
                            <label  class="form-label">Ativo<span class="sr-only"> </span></label>
                            <select  class="form-control" name="ativo"  >
                                @if(isset($usuario))
                                    @if($usuario->ativo == 1)
                                        <option value="1" selected>Sim</option>
                                        <option value="0">Não</option>
                                    @else
                                        <option value="1" >Sim</option>
                                        <option value="0" selected>Não</option>
                                    @endif
                                @else
                                    <option value="1" selected>Sim</option>
                                    <option value="0">Não</option>
                                @endif
                            </select>

                        </div>
                        <div class="col-md-4">
                            <label  class="form-label">Nome<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="nome" value="{{isset($nome)?$nome:old('nome',isset($usuario)?$usuario->name:'')}}" >
                            @error('nome')
                            <div class="invalid-feedback">{{@$message}}</div>
                            @enderror

                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label  class="form-label">Nome Completo<span class="required-indicator sr-only"> </span></label>
                            <input type="text" class="form-control" name="nome_completo" value="{{isset($nome_completo)?$nome_completo:old('nome_completo',isset($usuario)?$usuario->nome_completo:'')}}" >
                            @error('nome_completo')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror

                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-4">

                            <label  class="form-label">Email<span class="required-indicator sr-only"> </span></label>
                            <input type="text" class="form-control"  name="email" value="{{isset($email)?$email:old('email',isset($usuario)?$usuario->email:'')}}">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        @if(!isset($usuario))
                            <div class="col-md-4">

                                <label  class="form-label">Senha<span class="required-indicator sr-only"> </span></label>
                                <input type="password" class="form-control"  name="senha" >
                                @error('senha')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        @endif

                        <div class="col-md-4">

                            <label  class="form-label">Grupos<span class="required-indicator sr-only"> </span></label>
                            <select  class="form-control"  name="grupos[]" multiple size="1">
                                @foreach($grupos as $grupo)
                                    @if(isset($usuario))
                                        @if($usuario->grupos->contains('id',$grupo->id))
                                            <option value="{{$grupo->id}}" selected>{{$grupo->nome}}</option>
                                        @else
                                            <option value="{{$grupo->id}}" >{{$grupo->nome}}</option>
                                        @endif
                                    @else
                                        <option value="{{$grupo->id}}">{{$grupo->nome}}</option>
                                    @endif

                                @endforeach
                            </select>
                            @error('grupos')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        @if(!isset($usuario))
                            <div class="col-md-5">

                                <label  class="form-label">Imagem<span class="required-indicator sr-only"> </span></label>
                                <input type="file" class="form-control"  name="imagem" >
                                @error('imagem')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">

                                <label  class="form-label">Contato<span class="required-indicator sr-only"> </span></label>
                                <input type="text" class="form-control"  name="contato" value="{{isset($contato)?$contato:old('contato')}}">
                                @error('contato')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">APP<span class="required-indicator sr-only"> </span></label>
                                <div class="form-check">
                                    <input class="form-check-input" name="whatsapp" type="checkbox" >
                                    <label class="form-check-label" >
                                        Whatsapp
                                    </label>

                                </div>
                            </div>
                        @endif



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
