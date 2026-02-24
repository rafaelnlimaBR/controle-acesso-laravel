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
            <form class="atualizar-servico" action="{{route('contrato.servico.atualizar',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}" method="post">
            <tr class="align-middle">
                {{csrf_field()}}

                <td>{{$s->id}}<input  name="servico_id" value="{{$s->pivot->id}}"></td>
                <td>{{$s->nome}}</td>
                <td><input REQUIRED  class="form-control form-control-sm " name="valor_bruto" value="{{$s->pivot->valor_bruto}}"></td>
                <td><input REQUIRED class="form-control form-control-sm " name="desconto" value="{{$s->pivot->desconto}}"></td>
                <td><input REQUIRED class="form-control form-control-sm" name="valor_liquido" value="{{$s->pivot->valor_liquido}}"></td>
                <td>{{$h->status->nome}}</td>
                <td>
                    <select class="form-control form-control-sm" name="cobrar">
                        @if($s->pivot->cobrar == 1)
                            <option selected value="1"> Sim</option>
                            <option value="0">Não</option>
                        @else
                            <option  value="1"> Sim</option>
                            <option selected value="0">Não</option>
                        @endif

                    </select>
                </td>
                <td><button class="btn btn-sm btn-warning" type="submit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
            </tr>
            </form>
        @endforeach
    @endforeach

    </tbody>
</table>
