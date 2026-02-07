@extends('admin.layout')

@section('conteudo')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
            <div class="card-header"><h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Pesquisa </h3></div>
            <!-- /.card-header -->
            <div class="card-body">
                <form  action="{{route('usuario.index')}}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label  class="form-label">Nome<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="nome" value="{{request()->has('nome')?request()->get('nome'):""}}" >


                        </div>
                        <div class="col-md-3">
                            <label  class="form-label">Número<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="numero" value="{{request()->has('numero')?request()->get('numero'):""}}" >


                        </div>
                        <div class="col-md-3">
                            <label  class="form-label">Grupos<span class="sr-only"> </span></label>

                            <select class="form-control" name="grupo">
                                <option value="0">Todos</option>
                                @foreach($grupos as $g)
                                    @if(request()->has('grupo'))
                                        @if(request()->get('grupo')== $g->id)
                                            <option selected value="{{$g->id}}">{{$g->nome}}</option>
                                        @else
                                            <option value="{{$g->id}}">{{$g->nome}}</option>
                                        @endif
                                    @else
                                        <option value="{{$g->id}}">{{$g->nome}}</option>
                                    @endif

                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-1 ">
                            <label  class="form-label">Pesquisar<span class="sr-only"> </span></label>
                            <button type="submit" class="form-control btn btn-primary"   ><i class="bi bi-search"></i></button>


                        </div>


                    </div>
                </form>

            </div>
            <!-- /.card-body -->

        </div>

        <div class="card mb-5">
            <div class="card-header"><h3 class="card-title"><i class="bi bi-database"></i> {{$titulo_tabela}} </h3>
                <div class="card-tools">
                    <a class="btn btn-sm btn-primary" href="{{route('usuario.novo')}}"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
                </div></div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" role="table">
                    <thead>
                    <tr>
                        <th style="width: 10px" scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ativo</th>
                        <th scope="col">Grupos</th>

                        <th style="width: 5%" scope="col">Ações</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                        <tr class="align-middle">
                            <td>{{$usuario->id}}</td>
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>
                                <span class="badge  {{$usuario->ativo==1?"bg-success":"bg-danger"}}">{{$usuario->ativo==1?"Sim":"Não"}}</span>
                            </td>

                            <td>{{$usuario->grupos->pluck('nome')->join(', ')}}</td>
                            <td>
                                @can('usuario-visualizar')
                                <a title="detalhar" href=""><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                </a>
                                @endcan
                                @can('usuario-editar')
                                <a title="entrar" href="{{route('usuario.editar',['usuario'=>$usuario])}}" class="text-decoration-none">
                                    <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                </a>
                                @endcan

                            </td>


                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{$usuarios->links()}}
            </div>
        </div>
        <!-- /.card -->

        <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
</div>
@stop
