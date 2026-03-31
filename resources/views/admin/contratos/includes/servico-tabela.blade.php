

<table class="table table-bordered" role="table">
    <thead>
    <tr>
        <th style="width: 5%" scope="col">#</th>
        <th style="width: 30%" scope="col">Serviço</th>
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
        @foreach($h->servicos as $s)

            <tr class="align-middle">

                {{csrf_field()}}

                <td style="{{isset($servico_alterada_id)?$servico_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}" >
                    {{$s->id}}
                    <input hidden=""   id="servico-id-{{$s->id}}" value="{{$s->id}}">
                    <input hidden=""  id="historico-id-{{$s->id}}" value="{{$h->id}}">
                </td>
                <td style="{{isset($servico_alterada_id)?$servico_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}">{{$s->nome}}</td>
                <td style="{{isset($servico_alterada_id)?$servico_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><input REQUIRED ativo="valor-bruto" servico_id="{{$s->id}}" class="form-control form-control-sm calcular-valors-servico" id="valor-bruto-{{$s->id}}" name="valor-bruto-{{$s->id}}" value="{{$s->pivot->valor_bruto}}"></td>
                <td style="{{isset($servico_alterada_id)?$servico_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><input REQUIRED ativo="desconto" servico_id="{{$s->id}}" class="form-control form-control-sm calcular-valors-servico" id="desconto-{{$s->id}}" name="desconto-{{$s->id}}" value="{{$s->pivot->desconto}}"></td>
                <td style="{{isset($servico_alterada_id)?$servico_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><input REQUIRED ativo="valor-liquido" servico_id="{{$s->id}}" class="form-control form-control-sm calcular-valors-servico" id="valor-liquido-{{$s->id}}" name="valor-liquido-{{$s->id}}" value="{{$s->pivot->valor_liquido}}"></td>
                <td style="{{isset($servico_alterada_id)?$servico_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}">{{$h->status->nome}}</td>
                <td style="{{isset($servico_alterada_id)?$servico_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}">
                    <select class="form-control form-control-sm" id="cobrar-{{$s->id}}" name="cobrar-{{$s->id}}">
                        @if($s->pivot->cobrar == 1)
                            <option selected value="1"> Sim</option>
                            <option value="0">Não</option>
                        @else
                            <option  value="1"> Sim</option>
                            <option selected value="0">Não</option>
                        @endif

                    </select>
                </td>
                <td style="{{isset($servico_alterada_id)?$servico_alterada_id==$s->id?'background-color: #c5ffcd':'':''}}"><button servico-id="{{$s->id}}" class="btn btn-sm btn-warning botao-atualizar-servico" type="button" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                <button onclick="return confirm('Deseja excluir esse serviço? ')" servico-id="{{$s->id}}" historico-id="{{$h->id}}" class="btn btn-sm btn-danger botao-exluir-servico" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button></td>

            </tr>

        @endforeach
    @endforeach

    </tbody>
</table>
<br>
<div class="row">
    <div class="col-md-3">
        <table class="table table-bordered" role="table">
            <tr>
                <td> Valor Bruto : </td>
                <td> R$ : {{$contrato->valorBrutoTotalServicoAutorizado()}}</td>
            </tr>
            <tr>
                <td>Valor Líquido : </td>
                <td> R$ : {{$contrato->valorLiquidoTotalAutorizadoServico()}}</td>
            </tr>
        </table>
    </div>
</div>
