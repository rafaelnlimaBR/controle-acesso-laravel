<table class="table table-bordered" role="table">
    <thead>
    <tr>
        <th style="width: 15px" scope="col">#</th>
        <th style="width: 10%" scope="col">Status</th>
        <th style="width: 20%" scope="col">Serviço</th>
        <th style="width: 20%" scope="col">Valor Bruto</th>
        <th style="width: 20%" scope="col">Desconto</th>
        <th style="width: 20%" scope="col">Valor Líquido</th>
        <th style="width: 20%" scope="col">Cobrar</th>


    </tr>
    </thead>
    <tbody>

    @foreach($contrato->historicos as $h)
        @foreach($h->servicos as $s)
            <tr class="align-middle">
                <td>{{$s->id}}</td>
                <td>{{$h->status->nome}}</td>
                <td>{{$s->nome}}</td>
                <td>{{$s->pivot->valor_bruto}}</td>
                <td>{{$s->pivot->desconto}}</td>
                <td>{{$s->pivot->valor_liquido}}</td>
                <td>{{$s->pivot->cobrar}}</td>
            </tr>
        @endforeach
    @endforeach

    </tbody>
</table>
