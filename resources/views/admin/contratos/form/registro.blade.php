@extends('admin.layout')

@section('conteudo')
<div class="row">
    <div class="col-md-4">
        <form method="post" action="{{isset($registro)?route('contrato.registro.atualizar',['contrato'=>$contrato,'historico'=>$historico_selecionado,'registro'=>$registro]):route('contrato.registro.cadastrar',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}">
            {{csrf_field()}}


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
                                    @if(isset($registro))
                                        @if($registro->historico->id == $h->id)
                                            <option selected value="{{$h->id}}">{{$h->status->nome}}</option>
                                        @else
                                            <option  value="{{$h->id}}">{{$h->status->nome}}</option>
                                        @endif
                                    @else
                                        @if($historico_selecionado->id == $h->id)
                                            <option selected value="{{$h->id}}">{{$h->status->nome}}</option>

                                        @else
                                            <option  value="{{$h->id}}">{{$h->status->nome}}</option>
                                        @endif
                                    @endif

                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-4">
                            <label  class="form-label">Tipo de Registro<span class="sr-only"> </span></label>
                            <select class="form-control" name="tipo">
                                @foreach($tipos_registros as $tipo)
                                    @if(isset($registro))
                                        @if($registro->tipo->id == $tipo->id)
                                            <option selected value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                        @else
                                            <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                        @endif
                                    @else
                                        <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                    @endif

                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-4">
                            <label  class="form-label">Data<span class="sr-only"> </span></label>
                            <input name="data" value="{{isset($registro)?\Carbon\Carbon::parse($registro->data)->format('d/m/Y'):\Carbon\Carbon::now()->format('d/m/Y')}}" class="form-control datepicker" >
                            @error('data')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label  class="form-label">Descrição<span class="sr-only"> </span></label>
                            <textarea name="descricao" class="form-control">{{isset($descricao)?$descricao:old('descricao',isset($registro)?$registro->descricao:'')}}</textarea>
                            @error('descricao')
                            <div class="invalid-feedback">{{@$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @if(isset($registro))
                        <button class="btn btn-warning" type="submit">Editar</button>

                        <a onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" href="{{route('contrato.registro.excluir',['contrato'=>$contrato,'historico'=>$historico_selecionado,'registro'=>$registro])}}"  style="float: right">Excluir</a>
                    @else
                        <button class="btn btn-warning" type="submit">Cadastrar</button>
                    @endif
                    <a class="btn btn-dark" href="{{route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico_selecionado,'pagina'=>'registros'])}}">Voltar</a>
                </div>
            </div>

        </form>
    </div>
@if(isset($registro))

    <div class="col-md-8">
        <div class="card card-dark card-outline mb-4">
            <form enctype="multipart/form-data" action="{{route('contrato.registro.adicionar.imagens',['contrato'=>$contrato,'historico'=>$historico_selecionado,'registro'=>$registro])}}" method="post">
                {{csrf_field()}}
            <div class="card-header">
                <div class="card-title">Imagens</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <label  class="form-label">Descrição<span class="sr-only"> </span></label>
                        <textarea name="descricao" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label  class="form-label">Imagens<span class="sr-only"> </span></label>
                        <input MULTIPLE accept="image/*;capture=camera" name="imagens[]" type="file" class="form-control" value="{{old('imagens')}}">
                        @error('imagens')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
            </form>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>

                        <th>Imagem</th>
                        <th>Descrição</th>
                        <th>Data</th>
                        <th>Editar</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($registro->imagens as $imagem)
                        <form action="{{route('contrato.registro.atualizar.imagem',['contrato'=>$contrato,'historico'=>$historico_selecionado,'imagem'=>$imagem])}}" method="post">
                            <tr>
                                {{csrf_field()}}
                                <td><img style="height: 70px" src="{{url('/layout/imagens/registros/'.$imagem->nome)}}"> </td>
                                <td><textarea class="form-control" name="descricao">{{$imagem->descricao}}</textarea></td>
                                <td>{{\Carbon\Carbon::parse($imagem->created_at)->format('d/m/Y')}}</td>
                                <td><button class="btn btn-sm btn-warning">Editar</button>
                                    <a class="btn btn-sm btn-danger" href="{{route('contrato.registro.imagem.excluir',['contrato'=>$contrato,'historico'=>$historico_selecionado,'registro'=>$registro,'imagem'=>$imagem])}}">Excluir</a>
                                </td>
                            </tr>
                        </form>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endif
@endsection
