@extends('site.layout')
@section('conteudo')
    <div class="page-title position-relative">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{$titulo_pagina}}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Categories</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row">

            <div class="col-lg-8">

                <!-- Blog Posts Section -->
                <section id="blog-posts" class="blog-posts section">

                    <div class="container">
                        <div class="row gy-4">
                        @foreach($postagens as $postagem)
                            <div class="col-lg-6">
                                <article class="position-relative h-100">

                                    <div class="post-img position-relative overflow-hidden">
                                        <img src="{{url()->asset('images/postagens/'.$postagem->imagem->imagem)}}" class="img-fluid" alt="">
                                        <span class="post-date">{{\Carbon\Carbon::parse($postagem->created_at)->format('d/m/Y')}}</span>
                                    </div>

                                    <div class="post-content d-flex flex-column">

                                        <h3 class="post-title">{{$postagem->titulo}}</h3>

                                        <div class="meta d-flex align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-person"></i> <span class="ps-2">{{isset($postagem->autor)?$postagem->autor->name:""}}</span>
                                            </div>


                                        </div>

                                        {!!   Str::limit(strip_tags($postagem->conteudo), 150)!!}

                                        <hr>

                                        <a href="{{route('site.postagem',['link'=>$postagem->titulo_link])}}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                                    </div>

                                </article>
                            </div><!-- End post list item -->
                        @endforeach
                        </div>
                    </div>

                </section><!-- /Blog Posts Section -->

                <!-- Blog Pagination Section -->
                <section id="blog-pagination" class="blog-pagination section">

                    <div class="container">
                        <div class="d-flex justify-content-center">
                            {{$postagens->links()}}
                        </div>
                    </div>

                </section><!-- /Blog Pagination Section -->

            </div>

            <div class="col-lg-4 sidebar">

                @include('site.includes.widget')

            </div>

        </div>
    </div>

@endsection
