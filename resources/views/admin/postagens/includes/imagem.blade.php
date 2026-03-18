<div class="row">
    <div class="col-4">
        <div class="card shadow">
            <div class="card-header bg-light text-black">
                <h5 class="mb-0 pull-left">Formulário </h5>
                <a href="{{route('postagem.editar',['postagem'=>$postagem,'pagina'=>'imagens'])}}" class="btn btn-primary btn-sm pull-right"> Novo</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12" style="">

                        <form enctype="multipart/form-data" method="post" action="{{isset($imagem)?route('postagem.atualizar.imagem',['postagem'=>$postagem,'imagem'=>$imagem]):route('postagem.cadastrar.imagem',['postagem'=>$postagem])}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-2">
                                    <label  class="form-label">Ativo<span class="sr-only"> </span></label>
                                    <select  class="form-control" name="ativo" >
                                        @if(isset($imagem))
                                            @if($imagem->ativo == '1')
                                                <option value="1" selected> Sim</option>
                                                <option value="0" > Não</option>
                                            @else
                                                <option value="1" > Sim</option>
                                                <option value="0" selected> Não</option>
                                            @endif
                                        @else
                                            <option value="1" > Sim</option>
                                            <option value="0" > Não</option>
                                        @endif
                                    </select>

                                </div>
                                <div class="col-md-10">
                                    <label  class="form-label">Nome<span class="sr-only"> </span></label>
                                    <input type="text" class="form-control" name="nome_imagem" value="{{isset($imagem)?$imagem->nome:old('nome_imagem',isset($imagem)?$imagem->nome:'')}}" >
                                    @error('nome_imagem')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label  class="form-label">Descrição<span class="sr-only"> </span></label>
                                    <textarea class="form-control" name="descricao" >{{isset($imagem)?$imagem->descricao:old('descricao',isset($imagem)?$imagem->descricao:'')}}</textarea>
                                    @error('descricao')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror

                                </div>
                            </div>
                            @if(!isset($imagem))
                                <div class="row">
                                    <div class="col-md-12">
                                        <label  class="form-label">Imagem<span class="sr-only"> </span></label>
                                        <input multiple type="file" class="form-control" name="imagem_post" >
                                        @error('imagem_post')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="card-footer">
                                @if(isset($imagem))
                                    <input type="submit" class="btn btn-warning" value="Editar">
                                    <a onclick="return confirm('Deseja excluir esse imagem?')" type="submit" href="{{route('postagem.excluir.imagem',['postagem'=>$postagem,'imagem'=>$imagem])}}" class="btn btn-danger pull-right" >Excluir</a>

                                @else
                                    <input type="submit" class="btn btn-success" value="Gravar">
                                @endif

                            </div>



                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="col-8">
        <table class="table table-bordered" role="table">
            <thead>
            <tr>
                <th style="width: 10px" scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Imagem</th>


                <th style="width: 15%" scope="col">Ativo</th>
                {{--            <th style="width: 5%" scope="col">Ações</th>--}}

            </tr>
            </thead>
            <tbody>
            @foreach($postagem->imagens as $i)
                <tr class="align-middle" >
                    <td >{{$i->id}}</td>
                    <td>{{$i->nome}}</td>
                    <td><img src="{{asset('images/postagens/'.$i->imagem)}}" style="width: 100px; height: 40px"></td>

                    <td><span class="badge  {{$i->ativo==1?"bg-success":"bg-danger"}}">{{$postagem->ativo==1?"Sim":"Não"}}</span></td>
                    <td>
                        <a href="{{route('postagem.editar.imagem',['postagem'=>$postagem,'imagem'=>$i,'pagina'=>'imagens'])}}" class="text-decoration-none">
                            <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                        </a>
                    </td>


                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
