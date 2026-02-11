<div class="card">
    <div class="card-header">
        <div class="card-title">Editar Historico Selecionado - {{strtoupper($historico_selecionado->status->nome)}}</div>
    </div>
    <form action="{{route('contrato.editar.historico',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}" method="post">
    <div class="card-body">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-12">

                    <label for="descricao">Permissões</label>
                    <textarea class="form-control" name="descricao">{{$historico_selecionado->descricao}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label >Data</label>
                    <input name="data" class="form-control datepicker" value="{{\Carbon\Carbon::parse($historico_selecionado->data)->format('d/m/Y')}}">
                </div>
            </div>

    </div>
    <div class="card-footer">
        <button class="btn btn-warning" type="submit">Editar</button>
    </div>
    </form>
</div>
