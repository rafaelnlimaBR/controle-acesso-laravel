@extends('admin.layout')

@section('conteudo')
    <div class="row">
        <div class="col-md-6">

            <div class="card">


                <form method="post" action="{{isset($indicacao)?route('contrato.indicacao.atualizar',['contrato'=>$contrato,'historico'=>$historico_selecionado,'indicacao'=>$indicacao]):route('contrato.indicacao.cadastrar',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}">
                    {{csrf_field()}}



                    <div class="card-header">
                        <div class="card-title">{{$titulo_card}}</div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label  class="form-label">Historico<span class="sr-only"> </span></label>
                                <select class="form-control" name="historico">
                                    @foreach($contrato->historicos as $h)
                                        @if(isset($indicacao))
                                            @if($indicacao->historico->id == $h->id)
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
                            <div class="col-md-3">
                                <label  class="form-label">Fornecedor</label>

                                <select name="fornecedor" class="form-control " id="pesquisar-fornecedor">
                                    @if(isset($indicacao))
                                        <option value="{{$indicacao->fornecedor->id}}">{{$indicacao->fornecedor->name}}</option>
                                    @endif
                                </select>
                                @error('fornecedor')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label  class="form-label">Valor<span class="sr-only"> </span></label>
                                <input name="valor" value="{{isset($indicacao)?$indicacao->valor:''}}" class="form-control" >
                                @error('Valor')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>


                            <div class="col-md-3">
                                <label  class="form-label">Data<span class="sr-only"> </span></label>
                                <input name="data" value="{{isset($indicacao)?\Carbon\Carbon::parse($indicacao->data)->format('d/m/Y'):\Carbon\Carbon::now()->format('d/m/Y')}}" class="form-control datepicker" >
                                @error('data')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label  class="form-label">Descrição<span class="sr-only"> </span></label>
                                <textarea name="descricao" class="form-control">{{isset($descricao)?$descricao:old('descricao',isset($indicacao)?$indicacao->descricao:'')}}</textarea>
                                @error('descricao')
                                <div class="invalid-feedback">{{@$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if(isset($indicacao))
                            <button class="btn btn-warning" type="submit">Editar</button>

                            <a onclick="return confirm('Deseja excluir esse indicacao?')" class="btn btn-danger" href="{{route('contrato.indicacao.excluir',['contrato'=>$contrato,'historico'=>$historico_selecionado,'indicacao'=>$indicacao])}}"  style="float: right">Excluir</a>
                        @else
                            <button class="btn btn-warning" type="submit">Cadastrar</button>
                        @endif
                            @if(isset($route_back))
                                <a class="btn btn-dark" href="{{$route_back}}">Voltar</a>
                            @else
                                <a class="btn btn-dark" href="{{route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico_selecionado,'pagina'=>'indicacoes'])}}">Voltar</a>
                            @endif

                    </div>


                </form>
            </div>
        </div>
        @if(isset($indicacao))
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <a href="#" class="btn btn-primary">Novo (FAZER REGISTRO DE SAIDA)</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>


                            <th>Valor</th>
                            <th>Data</th>
                            <th>Editar</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($indicacao->saidas as $saida)

                                <tr>
                                    {{csrf_field()}}

                                    <td>{{$saida->valor}}</td>
                                    <td>{{\Carbon\Carbon::parse($saida->data)->format('d/m/Y')}}</td>
                                    <td><button class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        <a class="btn btn-sm btn-danger" href="{{route('contrato.indicacao.excluir',['contrato'=>$contrato,'historico'=>$historico_selecionado,'indicacao'=>$indicacao])}}"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

    </div>






@endsection
