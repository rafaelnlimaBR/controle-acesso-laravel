@extends('admin.layout')

@section('conteudo')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
            <div class="card-header"><h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Pesquisa </h3></div>
            <!-- /.card-header -->
            <div class="card-body">
                <form  action="{{route('veiculo.index')}}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label  class="form-label">Placa<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="placa"  value="{{request()->has('placa')?request()->get('placa'):""}}">
                        </div>

                        <div class="col-md-3">
                            <label  class="form-label">Modelo<span class="sr-only"> </span></label>
                            <select name="modelo" class="form-control">
                                <option value="0" {{request()->has('modelo')?request()->get('modelo')==0?'selected':'':''}}>Todos</option>
                                @foreach($modelos as $modelo)

                                    <option value="{{$modelo->id}}"  {{request()->has('modelo')?request()->get('modelo')==$modelo->id?'selected':'':''}}>{{$modelo->nome}}</option>
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
                    @can('veiculo-criar')
                    <a class="btn btn-sm btn-primary" href="{{route('veiculo.novo')}}"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
                    @endcan
                </div></div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" role="table">
                    <thead>
                    <tr>
                        <th style="width: 2%" scope="col">#</th>
                        <th style="width: 35%" scope="col">Placa</th>
                        <th style="width: 30%" scope="col">Modelo</th>
                        <th style="width: 5%" scope="col">Ações</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($veiculos as $veiculo)
                        <tr class="align-middle">
                            <td>{{$veiculo->id}}</td>
                            <td>{{$veiculo->placa}}</td>

                            <td>{{$veiculo->modelo->nome}}</td>
                            <td>
                                @can('veiculo-visualizar')
                                <a title="detalhar" href=""><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                </a>
                                @endcan
                                @can('veiculo-editar')
                                <a href="{{route('veiculo.editar',['veiculo'=>$veiculo])}}" class="text-decoration-none">
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
                {{$veiculos->links()}}
            </div>
        </div>
        <!-- /.card -->

        <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
</div>
@stop
