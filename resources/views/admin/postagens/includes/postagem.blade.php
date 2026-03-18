<div class="row">
    <form class="needs-validation" novalidate="" method="post" action="{{isset($postagem)?route('postagem.atualizar',['postagem'=>$postagem]):route('postagem.cadastrar')}}">
        {{csrf_field()}}
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row g-3">
                <div class="col-md-2">
                    <label  class="form-label">Ativo<span class="sr-only"> </span></label>
                    <select  class="form-control" name="ativo" >
                        @if(isset($postagem))
                            @if($postagem->ativo == '1')
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
                <!--begin::Col-->
                <div class="col-md-5">
                    <label  class="form-label">Titulo<span class="sr-only"> </span></label>
                    <input type="text" class="form-control" name="titulo_postagem" value="{{isset($titulo_postagem)?$titulo_postagem:old('titulo',isset($postagem)?$postagem->titulo:'')}}" >
                    @error('titulo_postagem')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror


                </div>
                <div class="col-md-5">
                    <label  class="form-label">Link<span class="sr-only"> </span></label>
                    <input type="text" class="form-control" name="titulo_link" value="{{isset($titulo_link)?$titulo_link:old('nome',isset($postagem)?$postagem->titulo_link:'')}}" >
                    @error('titulo_link')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror


                </div>


            </div>
            <div class="row">
                <div class="col-md-2">
                    <label  class="form-label">Categorias<span class="sr-only"> </span></label>
                    <select multiple size="1" class="form-control" name="categoria[]">
                        @foreach($categorias as $categoria)
                            @if(isset($postagem))
                                @if($postagem->categorias()->where('categoria_id',$categoria->id)->exists())
                                    <option selected value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @else
                                    <option  value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endif
                            @else
                                <option  value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('categoria')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror


                </div>
                <div class="col-md-2">
                    <label  class="form-label">Imagem<span class="sr-only"> </span></label>
                    <select   class="form-control" name="categoria">
                        @if(isset($postagem))
                            @foreach($postagem->imagens as $imagem)
                                <option value="{{$imagem->id}}">{{$imagem->nome}}</option>
                            @endforeach
                        @endif

                    </select>
                    @error('imagem')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror


                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label  class="form-label">Meta<span class="sr-only"> </span></label>
                    <textarea size="" class="form-control" name="meta_descricao" >{{isset($conteudo)?$conteudo:old('meta_descricao',isset($postagem)?$postagem->meta_descricao:'')}}</textarea>
                    @error('meta_descricao')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror


                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label  class="form-label">Conteudo<span class="sr-only"> </span></label>
                    <textarea id="summernote-contrato" type="text" class="form-control" name="conteudo">{{isset($conteudo)?$conteudo:old('nome',isset($postagem)?$postagem->conteudo:'')}}</textarea>
                    @error('conteudo')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror


                </div>
            </div>

            <!--end::Row-->
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
            @if(isset($postagem))
                <button class="btn btn-warning" type="submit">Editar</button>
                @can('postagem-deletar')
                    <a href="{{route('postagem.excluir',['postagem'=>$postagem])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
                @endcan
            @else
                <button class="btn btn-success" type="submit">Cadastrar</button>
            @endif

            <a href="{{route('postagem.index')}}" class="btn btn-dark" type="submit">Voltar </a>
        </div>
        <!--end::Footer-->
    </form>
</div>
