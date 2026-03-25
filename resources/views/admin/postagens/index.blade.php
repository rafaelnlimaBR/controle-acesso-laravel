@extends('admin.layout')

@section('conteudo')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
            <div class="card-header"><h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Pesquisa </h3></div>
            <!-- /.card-header -->
            <div class="card-body">
                <form  action="{{route('postagem.index')}}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label  class="form-label">Nome<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="titulo"  value="{{request()->has('titulo')?request()->get('titulo'):""}}">


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
                    @can('postagem-criar')
                    <a class="btn btn-sm btn-primary" href="{{route('postagem.novo')}}"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
                    @endcan
                </div></div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" role="table">
                    <thead>
                    <tr>
                        <th style="width: 10px" scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Link</th>
                        <th scope="col">Data</th>
                        <th scope="col">Categorias</th>
                        <th scope="col">Visitas</th>
                        <th style="width: 15%" scope="col">Ativo</th>
                        <th style="width: 5%" scope="col">Ações</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($postagens as $postagem)
                        <tr class="align-middle">
                            <td>{{$postagem->id}}</td>
                            <td>{{$postagem->titulo}}</td>
                            <td>{{$postagem->titulo_link}}</td>
                            <td>{{\Carbon\Carbon::parse($postagem->created_at)->format('d/m/Y H:i')}}</td>
                            <td>{{$postagem->categorias->count() >= 1? $postagem->categorias->pluck('nome')->join(', '):''}}</td>
                            <td>{{$postagem->visualizacoes}}</td>
                            <td><span class="badge  {{$postagem->ativo==1?"bg-success":"bg-danger"}}">{{$postagem->ativo==1?"Sim":"Não"}}</span></td>
                            <td>
                                @can('postagem-visualizar')
                                <a title="detalhar" href=""><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                </a>
                                @endcan
                                @can('postagem-editar')
                                <a href="{{route('postagem.editar',['postagem'=>$postagem])}}" class="text-decoration-none">
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
                {{$postagens->links()}}
            </div>
        </div>
        <!-- /.card -->

        <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
</div>
@stop
