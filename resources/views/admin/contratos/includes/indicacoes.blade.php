<div class="row">

    <div class="card-header">
        <a href="{{route('contrato.indicacao.novo',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}" class="btn btn-primary">Novo</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered" role="table">
            <thead>
            <tr>
                <th style="width: 5px" scope="col">#</th>
                <th style="width: 20%" scope="col">Fornecedor</th>
                <th style="width: 30%" scope="col">Descricao</th>
                <th style="width: 30%" scope="col">Historico</th>
                <th style="width: 20%" scope="col">Data</th>
                <th style="width: 10%" scope="col">Ações</th>

            </tr>
            </thead>
            <tbody>
                @foreach($contrato->historicos->map->indicacoes->flatten() as $indicacao)



                    <tr class="align-middle">
                        <td>{{$indicacao->id}}</td>
                        <td>{{$indicacao->fornecedor->name}}</td>
                        <td>{{$indicacao->descricao}}</td>
                        <td>{{$indicacao->historico->status->nome}}</td>
                        <td>{{\Carbon\Carbon::parse($indicacao->data)->format('d/m/Y')}}</td>

                        <td>
                            @can('contrato-indicacao-editar')
                                <a href="{{route('contrato.indicacao.editar',['contrato'=>$contrato,'historico'=>$historico_selecionado,'indicacao'=>$indicacao])}}" class="text-decoration-none">
                                    <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                </a>
                            @endcan
                        </td>


                    </tr>


                @endforeach

            </tbody>
        </table>
    </div>
</div>
