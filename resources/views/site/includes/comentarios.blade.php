<section id="blog-comments" class="blog-comments section">

    <div class="container">

        <h4 class="comments-count">{{$postagem->comentarios->count()}} Comentários</h4>

        @foreach($comentarios as $index_comentario =>$comentario)
            <div id="comment-{{$index_comentario+1}}" class="comment">
                <div class="d-flex">
                    {{--                                <div class="comment-img"><img src="assets/img/blog/comments-2.jpg" alt=""></div>--}}
                    <div>
                        <h5><a href="">{{$comentario->autor->name}}</a> </h5>
                        <time datetime="{{\Carbon\Carbon::parse($comentario->created_at)->format('Y-m-d')}}">{{\Carbon\Carbon::parse($comentario->created_at)->format('d/m/Y')}}</time>
                        <p>
                            {{$comentario->conteudo}}
                        </p>
                    </div>
                </div>
                @foreach($comentario->respostas as $index_resposta=>$resposta)
                    <div id="comment-reply-{{$index_resposta+1}}" class="comment comment-reply">
                        <div class="d-flex">
                            {{--                                    <div class="comment-img"><img src="assets/img/blog/comments-3.jpg" alt=""></div>--}}
                            <div>
                                <h5><a href="">{{$resposta->autor->name}}</a> </h5>
                                <time datetime="{{\Carbon\Carbon::parse($resposta->created_at)->format('Y-m-d')}}">{{\Carbon\Carbon::parse($resposta->created_at)->format('d/m/Y')}}</time>
                                <p>
                                    {{$resposta->conteudo}}
                                </p>
                            </div>
                        </div>
                    </div><!-- End comment reply #1-->
                @endforeach




            </div><!-- End comment #2-->
        @endforeach





    </div>

</section><!-- /Blog Comments Section -->

<!-- Comment Form Section -->

    <section id="comment-form" class="comment-form section">
        <div class="container">

            <form id="comentario-form" action="{{route('site.comentar')}}" method="post">

                <h4>Enviar Comentário</h4>
                <p>Seu email e whatsapp não será publicado. </p>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input name="nome" value="{{isset($nome)?$nome:''}}" type="text" class="form-control @error('nome')is-invalid @enderror" placeholder="Seu Nome*">
                        {{csrf_field()}}
                        <input hidden="" name="postagem_id" value="{{$postagem->id}}">
                        @error('nome')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <input name="whatsapp" value="{{isset($whatsapp)?$whatsapp:''}}"  type="text" class="form-control  @error('whatsapp')is-invalid @enderror" placeholder="Seu Whatsapp*">
                        @error('whatsapp')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <input name="email" value="{{isset($email)?$email:''}}" type="text" class="form-control @error('email')is-invalid @enderror" placeholder="Seu Email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <textarea name="conteudo"  class="form-control @error('conteudo')is-invalid @enderror" placeholder="Seu Comentário*">{{isset($conteudo)?$conteudo:''}}</textarea>
                        @error('conteudo')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Enviar Comentário</button>
                </div>

            </form>

        </div>
    </section><!-- /Comment Form Section -->


