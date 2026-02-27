

<table class="table table-bordered" role="table">
    <thead>
    <tr>
        <th style="width: 5%" scope="col">#</th>
        <th style="width: 20%" scope="col">Peça</th>
        <th style="width: 10%" scope="col">Marca</th>
        <th style="width: 10%" scope="col">Valor Bruto</th>
        <th style="width: 7%" scope="col">Desconto</th>
        <th style="width: 10%" scope="col">Valor Líquido</th>
        <th style="width: 7%" scope="col">Qnt</th>
        <th style="width: 7%" scope="col">Valor Total</th>
        <th style="width: 10%" scope="col">Status</th>
        <th style="width: 7%" scope="col">Cobrar</th>
        <th style="width: 5%" scope="col">Ações</th>



    </tr>
    </thead>
    <tbody>

    @foreach($contrato->historicos as $h)
        @foreach($h->pecasAvulsas as $s)
            <tr class="align-middle " >
                {{csrf_field()}}

                <td  style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}" >
                    {{$s->id}}
                    <input hidden=""   id="peca-avulsa-id-{{$s->id}}" value="{{$s->id}}">
                    <input hidden=""  id="historico-id-{{$s->id}}" value="{{$h->id}}">
                </td>
                <td style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><input REQUIRED  peca_id="{{$s->id}}" class="form-control form-control-sm " id="peca-nome-{{$s->id}}" name="nome-peca-{{$s->id}}" value="{{$s->nome}}"></td>
                <td style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><input REQUIRED  peca_id="{{$s->id}}" class="form-control form-control-sm " id="peca-marca-{{$s->id}}" name="marca-peca-{{$s->id}}" value="{{$s->marca}}"></td>
                <td style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><input REQUIRED ativo="valor-bruto" peca_id="{{$s->id}}" class="form-control form-control-sm calcular-valors-peca numero" id="peca-valor-bruto-{{$s->id}}" name="valor-bruto-{{$s->id}}" value="{{$s->valor_bruto}}"></td>

                <td style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><input REQUIRED ativo="desconto-peca" peca_id="{{$s->id}}" class="form-control form-control-sm calcular-valors-peca numero" id="peca-desconto-{{$s->id}}" name="desconto-{{$s->id}}" value="{{$s->desconto}}"></td>
                <td style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><input REQUIRED ativo="valor-liquido-peca" peca_id="{{$s->id}}" class="form-control form-control-sm calcular-valors-peca numero" id="peca-valor-liquido-{{$s->id}}" name="valor-liquido-{{$s->id}}" value="{{$s->valor_liquido}}"></td>
                <td style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><input REQUIRED ativo="qnt-peca" peca_id="{{$s->id}}" class="form-control form-control-sm calcular-valors-peca apenas-numeros" id="peca-qnt-{{$s->id}}" name="qnt-{{$s->id}}" value="{{$s->qnt}}"></td>
                <td style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><input class="form-control form-control-sm numero" id="valor-liquido-total-{{$s->id}}" disabled  value="{{$s->valor_liquido*$s->qnt}}"></td>
                <td style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}">{{$h->status->nome}}</td>
                <td style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}">
                    <select class="form-control form-control-sm" id="peca-cobrar-{{$s->id}}" name="peca-cobrar-{{$s->id}}">
                        @if($s->cobrar == 1)
                            <option selected value="1"> Sim</option>
                            <option value="0">Não</option>
                        @else
                            <option  value="1"> Sim</option>
                            <option selected value="0">Não</option>
                        @endif

                    </select>
                </td>
                <td style="{{isset($peca_avulsa_alterada_id)?$peca_avulsa_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><button peca-id="{{$s->id}}" class="btn btn-sm btn-warning botao-atualizar-pecaavulsa" type="button" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                <button onclick="return confirm('Deseja excluir essa peca? ')" peca-id="{{$s->id}}" historico-id="{{$h->id}}" class="btn btn-sm btn-danger botao-exluir-pecaavulsa" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button></td>

            </tr>

        @endforeach
    @endforeach

    </tbody>
</table>
<br>
<h4>R$ {{$contrato->valorLiquidoTotalServico()}}</h4>
