<div class="row">
    <div class="card-header">
        <a href="{{route('contrato.registro.novo',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}" class="btn btn-primary">Novo</a>
    </div>
    <div class="card-body">

        <table class="table table-bordered" role="table">
            <thead>
            <tr>
                <th style="width: 15px" scope="col">#</th>
                <th style="width: 20%" scope="col">Serviço</th>
                <th style="width: 20%" scope="col">Valor Bruto</th>
                <th style="width: 20%" scope="col">Desconto</th>
                <th style="width: 20%" scope="col">Valor Líquido</th>
                <th style="width: 20%" scope="col">Cobrar</th>


            </tr>
            </thead>
            <tbody>

            @foreach($contrato->historicos->map->servicos->flatten() as $s)
                <tr class="align-middle">
                    <td>{{$s->id}}</td>
                    <td>{{$s->nome}}</td>
                    <td>{{$s->pivot->valor_bruto}}</td>
                    <td>{{$s->pivot->desconto}}</td>
                    <td>{{$s->pivot->valor_liquido}}</td>
                    <td>{{$s->pivot->cobrar}}</td>



                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
