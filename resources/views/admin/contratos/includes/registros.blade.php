
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
                <th scope="col">Progress</th>
                <th style="width: 40px" scope="col">Label</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contrato->historicos as $h)
                @foreach($h->registros as $r)
                    <tr class="align-middle">

                        <td>{{$r->historico->status->nome}}</td>
                        <td>{{$r->tipo->nome}}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                            </div>
                        </td>
                        <td><span class="badge text-bg-danger">55%</span></td>
                    </tr>
                @endforeach
            @endforeach

            </tbody>
        </table>
    </div>
    </div>

</div>


