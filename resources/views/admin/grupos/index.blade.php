@extends('admin.layout')

@section('conteudo')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
            <div class="card-header"><h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Pesquisa </h3></div>
            <!-- /.card-header -->
            <div class="card-body">
                <form  action="{{route('grupo.index')}}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label  class="form-label">Nome<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="nome"  value="{{request()->has('nome')?request()->get('nome'):""}}">


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
                    @can('grupo-criar')
                    <button class="btn btn-sm btn-primary" href="{{route('grupo.novo')}}"><i class="fa fa-plus" aria-hidden="true"></i> Novo</button>
                    @endcan
                </div></div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" role="table">
                    <thead>
                    <tr>
                        <th style="width: 10px" scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th style="width: 15%" scope="col">Admin</th>
                        <th style="width: 15%" scope="col">Técnico</th>
                        <th style="width: 5%" scope="col">Ações</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($grupos as $grupo)
                        <tr class="align-middle">
                            <td>{{$grupo->id}}</td>
                            <td>{{$grupo->nome}}</td>
                            <td><span class="badge  {{$grupo->admin==1?"bg-success":"bg-danger"}}">{{$grupo->admin==1?"Sim":"Não"}}</span></td>
                            <td><span class="badge  {{$grupo->tecnico==1?"bg-success":"bg-danger"}}">{{$grupo->tecnico==1?"Sim":"Não"}}</span></td>
                            <td>
                                @can('grupo-visualizar')
                                <a title="detalhar" href=""><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                </a>
                                @endcan
                                @can('grupo-editar')
                                <a href="{{route('grupo.editar',['grupo'=>$grupo])}}" class="text-decoration-none">
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
                {{$grupos->links()}}
            </div>
        </div>
        <!-- /.card -->

        <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
</div>
@stop
