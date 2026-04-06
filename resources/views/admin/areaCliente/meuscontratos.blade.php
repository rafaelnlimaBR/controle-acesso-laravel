@extends('admin.layout')

@section('conteudo')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header"><h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Pesquisa </h3></div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="get"  action="{{route('cliente.meuscontratos')}}">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label  class="form-label">Placa<span class="sr-only"> </span></label>
                                <input type="text" class="form-control" name="placa"  value="{{request()->has('placa')?request()->get('placa'):""}}">


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
                        @can('servico-criar')
                            <a class="btn btn-sm btn-primary" href="{{route('servico.novo')}}"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
                        @endcan
                    </div></div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered" role="table">
                        <thead>
                        <tr>
                            <th style="width: 10px" scope="col">#</th>
                            <th scope="col">Veículo</th>
                            <th style="width: 15%"  scope="col">Data</th>
                            <th style="width: 5%" scope="col">Ações</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contratos as $contrato)
                            <tr class="align-middle">
                                <td>{{$contrato->id}}</td>
                                <td>{{isset($contrato->veiculo)?$contrato->veiculo->placa.' - '.$contrato->veiculo->modelo->nome:''}}</td>

                                <td>{{\Carbon\Carbon::parse($contrato->data_inicio)->format('d/m/Y')}}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
{{--                    {{$servicos->links()}}--}}
                </div>
            </div>
            <!-- /.card -->

            <!-- /.card -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
    </div>
@stop
