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

            <!-- Blog Details Section -->
            <section id="blog-details" class="blog-details section">
                <div class="container">

                    <article class="article">

                        <div class="post-img">
                            <img src="{{url()->asset('images/postagens/'.$postagem->imagem->imagem)}}" alt="" class="img-fluid">
                        </div>

                        <h2 class="title">{{$postagem->titulo}}</h2>

                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">{{$postagem->autor!=null?$postagem->autor->name:''}}</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01">{{Carbon\Carbon::parse($postagem->created_at)->format('d/m/Y')}}</time></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">{{$postagem->comentarios()->count()}}</a></li>
                            </ul>
                        </div><!-- End meta top -->

                        <div class="content">
                            {!! $postagem->conteudo !!}

                        </div><!-- End post content -->

                       {{-- <div class="meta-bottom">
                            <i class="bi bi-folder"></i>
                            <ul class="cats">
                                <li><a href="#">Business</a></li>
                            </ul>

                            <i class="bi bi-tags"></i>
                            <ul class="tags">
                                <li><a href="#">Creative</a></li>
                                <li><a href="#">Tips</a></li>
                                <li><a href="#">Marketing</a></li>
                            </ul>
                        </div><!-- End meta bottom -->--}}

                    </article>

                </div>
            </section><!-- /Blog Details Section -->

            <!-- Blog Comments Section -->
            <div id="comentarios">
            @include('site.includes.comentarios')
            </div>

        </div>

        <div class="col-lg-4 sidebar" >

            @include('site.includes.widget')

        </div>

    </div>
</div>
@endsection
