@extends('admin.layout')

@section('conteudo')

<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
            <div class="card-header"><h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Pesquisa </h3></div>
            <!-- /.card-header -->
            <div class="card-body">
                <form  action="{{route('contrato.index')}}">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label  class="form-label">Nome Cliente / Número Telefone<span class="sr-only"> </span></label>
                            <input autocomplete="off" type="text" class="form-control" name="cliente"  value="{{request()->has('cliente')?request()->get('cliente'):""}}">
                        </div>
                        <div class="col-md-2">
                            <label  class="form-label">Placa do Veículo<span class="sr-only"> </span></label>
                            <input autocomplete="off" type="text" class="form-control" name="placa"  value="{{request()->has('placa')?request()->get('placa'):""}}">
                        </div>
                        <div class="col-md-2">
                            <label  class="form-label">Data Criação<span class="sr-only"> </span></label>
                            <input autocomplete="off" type="text" class="form-control datepicker" name="data"  value="{{request()->has('data')?request()->get('data'):""}}">
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
                    @can('contrato-criar')
                    <a class="btn btn-sm btn-primary" href="{{route('contrato.novo')}}"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
                    @endcan
                </div></div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" role="table">
                    <thead>
                    <tr>
                        <th style="width: 15px" scope="col">#</th>
                        <th style="width: 20%" scope="col">Nome</th>
                        <th style="width: 20%" scope="col">Contatos</th>
                        <th style="width: 10%"  scope="col">Placa</th>
                        <th style="width: 30%"  scope="col">Veículo</th>
                        <th style="width: 20%"  scope="col">Status</th>
                        <th style="width: 15%" scope="col">Criado</th>
                        <th style="width: 5%" scope="col">Ações</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($contratos as $c)
                        <tr class="align-middle">
                            <td>{{$c->id}}</td>
                            <td>{{$c->cliente->name}}</td>
                            <td>{{$c->cliente->contatos->pluck('numero')->join(', ')}}</td>
                            <td>{{is_null($c->veiculo)?"":$c->veiculo->placa}}</td>
                            <td>{{is_null($c->veiculo)?"":$c->veiculo->modelo->nome}}</td>
                            <td><span style="background-color: {{'#'.$c->status->last()->cor_fundo}}; color: {{'#'.$c->status->last()->cor_letra}}; padding: 3px 5px 3px 5px;border-radius: 10px;">{{$c->status->last()->nome}}</span></td>
                            <td>{{\Carbon\Carbon::parse($c->data_inicio)->format('d/m/Y')}}</td>


                            <td>
                                @can('contrato-visualizar')
                                <a  title="detalhar" href="{{route('contrato.visualizar.pdf',['contrato'=>$c])}}"><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                </a>
                                @endcan
                                @can('contrato-editar')
                                <a href="{{route('contrato.editar',['contrato'=>$c,'historico'=>$c->historicos->last()])}}" class="text-decoration-none">
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
{{--                {{$contratos->links()}}--}}
            </div>
        </div>
        <!-- /.card -->

        <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
</div>
@stop
