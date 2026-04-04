@extends('site.layout')
@section('conteudo')

    <!-- Slider Section -->
    <section id="slider" class="slider section dark-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">

                <script type="application/json" class="swiper-config">
                    {
                      "loop": true,
                      "speed": 600,
                      "autoplay": {
                        "delay": 5000
                      },
                      "slidesPerView": "auto",
                      "centeredSlides": true,
                      "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                      },
                      "navigation": {
                        "nextEl": ".swiper-button-next",
                        "prevEl": ".swiper-button-prev"
                      }
                    }
                </script>

                <div class="swiper-wrapper">

                    @foreach($banners as $banner)
                        <div class="swiper-slide"
                             style="background-image: url({{url('images/banners/'.$banner->imagem)}});">
                            <div class="content">
                                <h2>
                                    @if($banner->link == null)
                                        <a>{{$banner->titulo}}</a>
                                    @else
                                        <a href="{{$banner->link}}">{{$banner->titulo}}</a>
                                    @endif
                                </h2>
                                <p>{{$banner->descricao}}</p>
                            </div>
                        </div>

                    @endforeach


                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Slider Section -->

    <!-- Trending Category Section -->


    <!-- Culture Category Section -->


    <!-- Business Category Section -->
    @foreach($cat as $categoria)


        <section id="lifestyle-category" class="lifestyle-category section">

            <!-- Section Title -->
            <div class="container section-title aos-init aos-animate" data-aos="fade-up">
                <div class="section-title-container d-flex align-items-center justify-content-between">
                    <h2>{{$categoria->nome}}</h2>
                    <p><a href="{{route('site.categoria',['link'=>$categoria->nome_link])}}">Veja todos </a></p>
                </div>
            </div><!-- End Section Title -->

            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-5">
                    <div class="col-lg-4">

                            <h6>Mais visualizado</h6>
                            <div class="post-list lg">
                                <a href="{{route('site.postagem',['link'=>$categoria->maisVisualizada()->titulo_link])}}"><img src="{{url()->asset('images/postagens/'.$categoria->maisVisualizada()->imagem->imagem)}}" alt="" class="img-fluid"></a>
                                <div class="post-meta"><span class="date"></span> <span class="mx-1">•</span> <span>{{\Carbon\Carbon::parse($categoria->maisVisualizada()->created_at)->format('d/m/Y')}}</span></div>
                                <h2><a href="{{route('site.postagem',['link'=>$categoria->maisVisualizada()->titulo_link])}}">{{$categoria->maisVisualizada()->titulo}}</a></h2>
                                <p class="mb-4 d-block">{!!   Str::limit(strip_tags($categoria->maisVisualizada()->conteudo), 130,'........')!!}</p>

                                <div class="d-flex align-items-center author">
{{--                                        <div class="photo"><img src="assets/img/person-7.jpg" alt="" class="img-fluid"></div>--}}
                                    <div class="name">
                                        <h3 class="m-0 p-0">{{$categoria->maisVisualizada()->autor->name}}</h3>
                                    </div>
                                </div>
                            </div>




                        {{--<div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list">
                            <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>--}}

                    </div>

                    <div class="col-lg-8">
                        <div class="row g-5">

                            <div class="col-lg-4 border-start custom-border">
                                <h6>Ultimas postagens</h6>
                                @foreach($categoria->ultimasPostagens(3) as $postagem)
                                <div class="post-list">
                                    <a href="{{route('site.postagem',['link'=>$postagem->titulo_link])}}"><img src="{{url()->asset('images/postagens/'.$postagem->imagem->imagem)}}" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date"></span> <span class="mx-1">•</span> <span>{{\Carbon\Carbon::parse($postagem->created_at)->format('d/m/Y')}}</span></div>
                                    <h2><a href="{{route('site.postagem',['link'=>$postagem->titulo_link])}}">{{$postagem->titulo}}</a></h2>
                                </div>
                                @endforeach

                            </div>
                            <div class="col-lg-4 border-start custom-border">
                                <h6>Mais visualizadas</h6>

                                @foreach($categoria->postagensMaisVisualizadas(3) as $postagem)
                                <div class="post-list">
                                    <a href="{{route('site.postagem',['link'=>$postagem->titulo_link])}}"><img src="{{url()->asset('images/postagens/'.$postagem->imagem->imagem)}}" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date"></span> <span class="mx-1">•</span> <span>{{\Carbon\Carbon::parse($postagem->created_at)->format('d/m/Y')}}</span></div>
                                    <h2><a href="{{route('site.postagem',['link'=>$postagem->titulo_link])}}">{{$postagem->titulo}}</a></h2>
                                </div>
                                @endforeach

                            </div>
                            <div class="col-lg-4">
                                @foreach($categoria->primeirasPostagens(6) as $postagem)
                                <div class="post-list border-bottom">
                                    <div class="post-meta"><span class="date"></span> <span class="mx-1">•</span> <span>{{\Carbon\Carbon::parse($postagem->created_at)->format('d/m/Y')}}</span></div>
                                    <h2 class="mb-2"><a href="{{route('site.postagem',['link'=>$postagem->titulo_link])}}">{{$postagem->titulo}}</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>
                                @endforeach


                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section>

    <!-- Lifestyle Category Section -->
    @endforeach
@endsection
