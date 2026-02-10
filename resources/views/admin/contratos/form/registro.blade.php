@extends('admin.layout')

@section('conteudo')
<form method="post" action="{{isset($registro)?'':route('contrato.registro.cadastrar',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}">
    {{csrf_field()}}
<div class="col-md-4">
    <div class="card card-dark card-outline mb-4">
        <div class="card-header">
            <div class="card-title">{{$titulo_card}}</div>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label  class="form-label">Historico<span class="sr-only"> </span></label>
                    <select class="form-control" name="historico">
                        @foreach($contrato->historicos as $h)
                            <option value="{{$h->id}}">{{$h->status->nome}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-4">
                    <label  class="form-label">Tipo de Registro<span class="sr-only"> </span></label>
                    <select class="form-control" name="tipo">
                        @foreach($tipos_registros as $tipo)
                            <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-4">
                    <label  class="form-label">Data<span class="sr-only"> </span></label>
                    <input name="data" value="" class="form-control datepicker">
                    @error('data')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label  class="form-label">Descrição<span class="sr-only"> </span></label>
                    <textarea name="descricao" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if(isset($registro))
                <button class="btn btn-warning" type="submit">Editar</button>
            @else
                <button class="btn btn-warning" type="submit">Cadastrar</button>
            @endif
            <a class="btn btn-dark" href="{{route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico_selecionado,'pagina'=>'registros'])}}">Voltar</a>
        </div>
    </div>
</div>
</form>
@endsection
