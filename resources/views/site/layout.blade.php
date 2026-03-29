<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{isset($titulo)?$titulo:$conf->nome_simples}}</title>
    <meta name="description" content="{{isset($meta_descricao)?$meta_descricao:$conf->meta_descricao}}">
    <meta name="keywords" content="{{isset($meta_keywords)?$meta_keywords:$conf->meta_descricao}}">

    <!-- Favicons -->
    <link href="{{url()->asset('favicon.ico')}}" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <!-- Vendor CSS Files -->
    <link href="{{url()->asset('layout/css/bootstrap5/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url()->asset('layout/plugins/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{url()->asset('layout/plugins/aos/aos.css')}}" rel="stylesheet">
    <link href="{{url()->asset('layout/plugins/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{url()->asset('layout/css/site.css')}}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: ZenBlog
    * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
    * Updated: Aug 08 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body class="starter-page-page">

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">ZenBlog</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{route('site.index')}}">Início</a></li>
{{--                <li><a href="about.html">About</a></li>--}}

                <li class="dropdown"><a href="#"><span>Categorias</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        @foreach($categorias as $categoria)
                            <li><a href="{{route('site.categoria',['link'=>$categoria->nome_link])}}">{{$categoria->nome}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li> <a target="new" class="" href="{{route('site.fazer.orcamento')}}">Fazer Orçamento</a></li>
{{--                <li><a href="contact.html">Contact</a></li>--}}
                @if(auth()->check())
                    <li><a href="{{route('dashboard.index')}}">Área Administrativa</a></li>
                @endif

            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="header-social-links">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>

    </div>
</header>

<main class="main">


    @yield('conteudo')

</main>

<footer id="footer" class="footer dark-background">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index.html" class="logo d-flex align-items-center">
                    <span class="sitename">ZenBlog</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>A108 Adam Street</p>
                    <p>New York, NY 535022</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                    <p><strong>Email:</strong> <span>info@example.com</span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Terms of service</a></li>
                    <li><a href="#">Privacy policy</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">Product Management</a></li>
                    <li><a href="#">Marketing</a></li>
                    <li><a href="#">Graphic Design</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Hic solutasetp</h4>
                <ul>
                    <li><a href="#">Molestiae accusamus iure</a></li>
                    <li><a href="#">Excepturi dignissimos</a></li>
                    <li><a href="#">Suscipit distinctio</a></li>
                    <li><a href="#">Dilecta</a></li>
                    <li><a href="#">Sit quas consectetur</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Nobis illum</h4>
                <ul>
                    <li><a href="#">Ipsam</a></li>
                    <li><a href="#">Laudantium dolorum</a></li>
                    <li><a href="#">Dinera</a></li>
                    <li><a href="#">Trodelas</a></li>
                    <li><a href="#">Flexo</a></li>
                </ul>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">ZenBlog</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon
        </div>
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ URL::asset('layout/js/jquery-3.2.1.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script src="{{url()->asset('layout/js/bootstrap5/bootstrap.bundle.min.js')}}"></script>
<script src="{{url()->asset('layout/js/bootstrap5/bootstrap.bundle.min.js')}}"></script>
<script src="{{url()->asset('layout/plugins/aos/aos.js')}}"></script>
<script src="{{url()->asset('layout/plugins/swiper/swiper-bundle.min.js')}}"></script>

<!-- Main JS File -->
<script src="{{url()->asset('layout/js/site.js')}}"></script>
<script type="text/javascript">
   $(document).ready(function (){
       $(document).on("submit", "#comentario-form", function(e) {
           var dados   = $(this).serialize();
           var rota    =   $(this).attr("action");
           $.post(rota, dados, function(data) {
               if('error' in data){
                   alert(data.error)
               }
               $('#comentarios').html(data.comentarios);

           });


           return false;
       });
   })

</script>
</body>

</html>
