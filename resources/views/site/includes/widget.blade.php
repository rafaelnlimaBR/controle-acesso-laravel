<div class="widgets-container">

    <!-- Blog Author Widget 2 -->
    <div class="blog-author-widget-2 widget-item">

        <div class="d-flex flex-column align-items-center">
            <img src="assets/img/blog/blog-author.jpg" class="rounded-circle flex-shrink-0" alt="">
            <h4>Jane Smith</h4>
            <div class="social-links">
                <a href="https://x.com/#"><i class="bi bi-twitter-x"></i></a>
                <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                <a href="https://instagram.com/#"><i class="biu bi-linkedin"></i></a>
            </div>

            <p>
                Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
            </p>

        </div>
    </div><!--/Blog Author Widget 2 -->

    <!-- Search Widget -->
    <div class="search-widget widget-item">

        <h3 class="widget-title">Pesquisa</h3>
        <form action="{{route('site.postagens')}}" method="get">
            <input type="text" name="pesquisa" >
            <button type="submit" title="Pesquisa"><i class="bi bi-search"></i></button>
        </form>

    </div><!--/Search Widget -->

    <!-- Recent Posts Widget -->
    <div class="recent-posts-widget widget-item">

        <h3 class="widget-title">Postagens mais recentes</h3>

        @foreach($postagens_recentes as $postagem)
            <div class="post-item">
                <img src="{{url()->asset('images/postagens/'.$postagem->imagem->imagem)}}" alt="" class="flex-shrink-0">
                <div>
                    <h4><a href="blog-details.html">{{$postagem->titulo}}</a></h4>
                    <time datetime="{{\Carbon\Carbon::parse($postagem->created_at)->format('Y-m-d')}}">{{\Carbon\Carbon::parse($postagem->created_at)->format('d/m/Y')}}</time>
                </div>
            </div><!-- End recent post item-->
        @endforeach



    </div><!--/Recent Posts Widget -->

    <!-- Tags Widget -->
   {{-- <div class="tags-widget widget-item">

        <h3 class="widget-title">Fazer Um Orçamento</h3>
        <ul>
            <li><a href="#">App</a></li>
            <li><a href="#">IT</a></li>
            <li><a href="#">Business</a></li>
            <li><a href="#">Mac</a></li>
            <li><a href="#">Design</a></li>
            <li><a href="#">Office</a></li>
            <li><a href="#">Creative</a></li>
            <li><a href="#">Studio</a></li>
            <li><a href="#">Smart</a></li>
            <li><a href="#">Tips</a></li>
            <li><a href="#">Marketing</a></li>
        </ul>

    </div><!--/Tags Widget -->--}}

</div>
