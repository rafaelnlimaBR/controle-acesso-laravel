
<div class="row">
    <div class="card-header">
        <a href="{{route('contrato.registro.novo',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}" class="btn btn-primary">Novo</a>
    </div>
    <div class="card-body">
        <div class="col-md-5">
        <table class="table table-bordered" role="table">
            <thead>
            <tr>

                <th scope="col">Orçamento</th>
                <th scope="col">Tipo</th>
                <th scope="col">Data</th>
                <th style="width: 40px" scope="col">Label</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contrato->historicos as $h)
                @foreach($h->registros as $r)
                    <tr class="align-middle">

                        <td>{{$r->historico->status->nome}}</td>
                        <td>{{$r->tipo->nome}}</td>
                        <td>{{\Carbon\Carbon::parse($r->data)->format('d/m/Y')}}
                        </td>
                        <td><a href="{{route('contrato.registro.editar',['contrato'=>$contrato,'historico'=>$historico_selecionado,'registro'=>$r])}}" style="text-decoration: none"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
            @endforeach

            </tbody>
        </table>
    </div>
    </div>

</div>


