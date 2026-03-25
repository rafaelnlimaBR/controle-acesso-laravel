<div class="row">
    @if(isset($comentarios))
    <div class="col-6">



            <div class="card shadow">

                <div class="card-header bg-light text-black">
                    <h5 class="mb-0">Comentários do Post</h5>
                </div>

                <div class="card-body">

                    <!-- NOVO COMENTÁRIO -->
                    <form method="POST" action="{{route('postagem.cadastrar.comentario',['postagem'=>$postagem])}}" class="mb-4">
                        {{csrf_field()}}
                        <div class="mb-2">
                            <textarea class="form-control" name="conteudo" placeholder="Escreva um comentário..." ></textarea>
                            @error('conteudo')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Comentar</button>

                    </form>


                    <!-- COMENTÁRIO 1 -->

                    @foreach($comentarios as $comentario)
                        <div class="border-bottom pb-3 mb-3">

                            <div class="d-flex justify-content-between">
                                <strong>{{$comentario->autor->name}}</strong>
                                <small class="text-muted">{{\Carbon\Carbon::parse($comentario->created_at)->format('d/m/Y H:i')}}</small>
                            </div>

                            <p>{{$comentario->conteudo}}</p>

                            <!-- RESPOSTAS -->
                           @foreach($comentario->respostas as $resposta)
                                <div class="bg-light p-2 rounded mt-2 ms-4">

                                    <div class="d-flex justify-content-between">
                                        <strong>{{$resposta->autor->name}}</strong>
                                        <small class="text-muted">{{\Carbon\Carbon::parse($resposta->created_at)->format('d/m/Y H:i')}}</small>
                                    </div>

                                    <p class="mb-0">{{$resposta->conteudo}}</p>

                                </div>
                           @endforeach

                            <!-- FORM RESPOSTA -->
                            <form method="POST" action="{{route('postagem.cadastrar.resposta',['postagem'=>$postagem,'comentario'=>$comentario])}}" class="mt-2">
                                {{csrf_field()}}
                                <input type="hidden" name="comentario" value="{{$comentario->id}}">

                                <div class="mb-2">
                                    <textarea class="form-control" name="resposta-{{$comentario->id}}" placeholder="Responder..." ></textarea>
                                    @error("resposta-$comentario->id")
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-sm btn-primary">Responder</button>

                            </form>



                        </div>
                    @endforeach






                </div>
                <div class="card-footer">
                    {{$comentarios->links()}}
                </div>
            </div>




    </div>
    <div class="col-6">
        awd
    </div>
    @endif

</div>
