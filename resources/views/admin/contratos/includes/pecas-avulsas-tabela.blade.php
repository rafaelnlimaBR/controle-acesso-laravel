

<table class="table table-bordered" role="table">
    <thead>
    <tr>
        <th style="width: 5%" scope="col">#</th>
        <th style="width: 30%" scope="col">Peça</th>
        <th style="width: 10%" scope="col">Marca</th>
        <th style="width: 10%" scope="col">Valor Bruto</th>
        <th style="width: 7%" scope="col">Desconto</th>
        <th style="width: 10%" scope="col">Valor Líquido</th>
        <th style="width: 10%" scope="col">Status</th>
        <th style="width: 10%" scope="col">Cobrar</th>
        <th style="width: 5%" scope="col">Ações</th>



    </tr>
    </thead>
    <tbody>

    @foreach($contrato->historicos as $h)
        @foreach($h->pecasAvulsas as $s)

            <tr class="align-middle">

                {{csrf_field()}}

                <td>
                    {{$s->id}}
                    <input hidden=""   id="peca-avulsa-id-{{$s->id}}" value="{{$s->id}}">
                    <input hidden=""  id="historico-id-{{$s->id}}" value="{{$h->id}}">
                </td>
                <td><input REQUIRED  peca_id="{{$s->id}}" class="form-control form-control-sm " id="nome-peca-{{$s->id}}" name="nome-peca-{{$s->id}}" value="{{$s->nome}}"></td>
                <td><input REQUIRED  peca_id="{{$s->id}}" class="form-control form-control-sm " id="marca-peca-{{$s->id}}" name="marca-peca-{{$s->id}}" value="{{$s->marca}}"></td>
                <td><input REQUIRED ativo="valor-bruto" peca_id="{{$s->id}}" class="form-control form-control-sm calcular-valors-peca" id="peca-valor-bruto-{{$s->id}}" name="valor-bruto-{{$s->id}}" value="{{$s->valor_bruto}}"></td>
                <td><input REQUIRED ativo="desconto" peca_id="{{$s->id}}" class="form-control form-control-sm calcular-valors-peca" id="peca-desconto-{{$s->id}}" name="desconto-{{$s->id}}" value="{{$s->desconto}}"></td>
                <td><input REQUIRED ativo="valor-liquido" peca_id="{{$s->id}}" class="form-control form-control-sm calcular-valors-peca" id="peca-valor-liquido-{{$s->id}}" name="valor-liquido-{{$s->id}}" value="{{$s->valor_liquido}}"></td>
                <td>{{$h->status->nome}}</td>
                <td>
                    <select class="form-control form-control-sm" id="cobrar-{{$s->id}}" name="cobrar-{{$s->id}}">
                        @if($s->cobrar == 1)
                            <option selected value="1"> Sim</option>
                            <option value="0">Não</option>
                        @else
                            <option  value="1"> Sim</option>
                            <option selected value="0">Não</option>
                        @endif

                    </select>
                </td>
                <td><button peca-id="{{$s->id}}" class="btn btn-sm btn-warning botao-atualizar-servico" type="button" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                <button onclick="return confirm('Deseja excluir essa peca? ')" peca-id="{{$s->id}}" peca-id="{{$h->id}}" class="btn btn-sm btn-danger botao-exluir-peca" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button></td>

            </tr>

        @endforeach
    @endforeach

    </tbody>
</table>
<br>
<h4>R$ {{$contrato->valorLiquidoTotalServico()}}</h4>
