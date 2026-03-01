<div class="row">
    <div class="card-header" id="form-peca-avulsa">
        @foreach($tipos_entradas as $tipo)
            <a class="btn btn-primary btn-sm" href="{{route('contrato.pagamento.novo',['contrato'=>$contrato,'historico'=>$historico_selecionado,'tipo'=>$tipo])}}">{{$tipo->nome}}</a>
        @endforeach
{{--        <a class="btn btn-primary " href="{{route('contrato.pagamento.novo',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}">Novo</a>--}}
    </div>
    <div class="card-body" >

        <table class="table table-bordered" role="table">
            <thead>
            <tr>
                <th style="width: 5%" scope="col">#</th>
                <th style="width: 10%" scope="col">Valor</th>
                <th style="width: 10%" scope="col">Data</th>
                <th style="width: 10%" scope="col">Tipo</th>
                <th style="width: 10%" scope="col">Autor</th>

                <th style="width: 5%" scope="col">Ações</th>



            </tr>
            </thead>
            <tbody>

            @foreach($contrato->historicos as $h)
                @foreach($h->entradas as $s)
                    <tr class="align-middle " >

                        <td >{{$s->id}}</td>
                        <td >{{$s->valor}}</td>
                        <td >{{\Carbon\Carbon::parse($s->data)->format('d/m/Y H:i')}}</td>
                        <td>{{$s->taxa->tipo->nome." - ".$s->taxa->nome}}</td>
                        <td>{{$s->autor->name}}</td>
                        <td style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><button peca-id="{{$s->id}}" class="btn btn-sm btn-warning botao-atualizar-pecaavulsa" type="button" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button onclick="return confirm('Deseja excluir essa peca? ')" peca-id="{{$s->id}}" historico-id="{{$h->id}}" class="btn btn-sm btn-danger botao-exluir-pecaavulsa" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button></td>

                    </tr>

                @endforeach
            @endforeach

            </tbody>
        </table>
        <br>


    </div>
</div>
