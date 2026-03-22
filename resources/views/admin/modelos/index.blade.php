@extends('admin.layout')

@section('conteudo')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
            <div class="card-header"><h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Pesquisa </h3></div>
            <!-- /.card-header -->
            <div class="card-body">
                <form  action="{{route('modelo.index')}}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label  class="form-label">Nome<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="nome"  value="{{request()->has('nome')?request()->get('nome'):""}}">


                        </div>
                        <div class="col-md-3">
                            <label  class="form-label">Montadora<span class="sr-only"> </span></label>
                            <select name="montadora" class="form-control" id="montadora-select2">
                                <option  value="0">Todos</option>
                                @foreach($montadoras as $montadora)
                                    @if(request()->has('montadora'))
                                        @if(request('montadora') == $montadora->id)
                                            <option selected value="{{$montadora->id}}">{{$montadora->nome}}</option>
                                        @else
                                            <option value="{{$montadora->id}}">{{$montadora->nome}}</option>
                                        @endif
                                    @else
                                        <option value="{{$montadora->id}}">{{$montadora->nome}}</option>
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
                    @can('modelo-criar')
                    <a class="btn btn-sm btn-primary" href="{{route('modelo.novo')}}"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
                    @endcan
                </div></div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" role="table">
                    <thead>
                    <tr>
                        <th style="width: 10px" scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Montadora</th>
                        <th style="width: 5%" scope="col">Ações</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modelos as $modelo)
                        <tr class="align-middle">
                            <td>{{$modelo->id}}</td>
                            <td>{{$modelo->nome}}</td>
                            <td>{{$modelo->montadora->nome}}</td>
                            <td>
                                @can('modelo-visualizar')
                                <a title="detalhar" href=""><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                </a>
                                @endcan
                                @can('modelo-editar')
                                <a href="{{route('modelo.editar',['modelo'=>$modelo])}}" class="text-decoration-none">
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
                {{$modelos->links()}}
            </div>
        </div>
        <!-- /.card -->

        <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
</div>
@stop
