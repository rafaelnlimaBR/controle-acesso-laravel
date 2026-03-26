
@extends('admin.layout')

@section('conteudo')
    <div class="col-6">
        <form action="{{route('postagem.atualizar.comentario',['postagem'=>$postagem,'comentario'=>$comentario])}}" method="post">
        <div class="card shadow">
            <div class="card-header bg-light text-black">
                <h5>{{$titulo_card}}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <label  class="form-label">Conteudo<span class="sr-only"> </span></label>
                        <textarea class="form-control" name="conteudo">{{$comentario->conteudo}}</textarea>
                        {{csrf_field()}}
                        @error('conteudo')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label  class="form-label">Status<span class="sr-only"> </span></label>
                        <select  class="form-control" name="ativo" >

                            @if($comentario->ativo == '1')
                                <option value="1" selected> Sim</option>
                                <option value="0" > Não</option>
                            @else
                                <option value="1" > Sim</option>
                                <option value="0" selected> Não</option>
                            @endif

                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('postagem.editar',['postagem'=>$postagem,'pagina'=>'comentarios'])}}" class="btn btn-dark text-white">Voltar</a>
                <button class="btn btn-warning">Editar</button>

                <a class="btn btn-danger text-white pull-right">Excluir</a>
            </div>
        </div>
        </form>
    </div>
@endsection
