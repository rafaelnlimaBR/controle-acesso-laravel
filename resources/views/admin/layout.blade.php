<!doctype html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$titulo_pagina}}</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="Layout | AdminLTE 4" />
    <meta name="author" content="ColorlibHQ" />
    <meta
        name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance."
    />
    <meta
        name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ URL::asset('layout/css/adminlte.css') }}" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link href="{{url()->asset('favicon.png')}}" rel="icon">
    <link href="{{ URL::asset('layout/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('layout/css/icons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('layout/plugins/colorpicker/colorpicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('layout/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="{{ URL::asset('layout/plugins/jquery-multi-select/multi-select.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous"
        media="print"
        onload="this.media='all'"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.css"
    />

    <link rel="stylesheet" href="{{ URL::asset('layout/plugins/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('layout/css/adminlte.css') }}" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
        integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
<script src="{{ URL::asset('layout/js/jquery-3.2.1.min.js') }}"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
    integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<!--begin::App Wrapper-->
<div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Start Navbar Links-->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
            </ul>
            <!--end::Start Navbar Links-->
            <!--begin::End Navbar Links-->
            <ul class="navbar-nav ms-auto">
                <!--begin::Navbar Search-->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <!--end::Navbar Search-->
                <!--begin::Messages Dropdown Menu-->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-chat-text"></i>
                        <span class="navbar-badge badge text-bg-danger">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <a href="#" class="dropdown-item">
                            <!--begin::Message-->
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img
                                        src="../assets/img/user1-128x128.jpg"
                                        alt="User Avatar"
                                        class="img-size-50 rounded-circle me-3"
                                    />
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-end fs-7 text-danger"
                                        ><i class="bi bi-star-fill"></i
                                            ></span>
                                    </h3>
                                    <p class="fs-7">Call me whenever you can...</p>
                                    <p class="fs-7 text-secondary">
                                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                    </p>
                                </div>
                            </div>
                            <!--end::Message-->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!--begin::Message-->
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img
                                        src="../assets/img/user8-128x128.jpg"
                                        alt="User Avatar"
                                        class="img-size-50 rounded-circle me-3"
                                    />
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-end fs-7 text-secondary">
                          <i class="bi bi-star-fill"></i>
                        </span>
                                    </h3>
                                    <p class="fs-7">I got your message bro</p>
                                    <p class="fs-7 text-secondary">
                                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                    </p>
                                </div>
                            </div>
                            <!--end::Message-->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!--begin::Message-->
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img
                                        src="../assets/img/user3-128x128.jpg"
                                        alt="User Avatar"
                                        class="img-size-50 rounded-circle me-3"
                                    />
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-end fs-7 text-warning">
                          <i class="bi bi-star-fill"></i>
                        </span>
                                    </h3>
                                    <p class="fs-7">The subject goes here</p>
                                    <p class="fs-7 text-secondary">
                                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                    </p>
                                </div>
                            </div>
                            <!--end::Message-->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!--end::Messages Dropdown Menu-->
                <!--begin::Notifications Dropdown Menu-->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-bell-fill"></i>
                        <span class="navbar-badge badge text-bg-warning">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-envelope me-2"></i> 4 new messages
                            <span class="float-end text-secondary fs-7">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-people-fill me-2"></i> 8 friend requests
                            <span class="float-end text-secondary fs-7">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                            <span class="float-end text-secondary fs-7">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
                    </div>
                </li>
                <!--end::Notifications Dropdown Menu-->
                <!--begin::Fullscreen Toggle-->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                        <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                        <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                    </a>
                </li>
                <!--end::Fullscreen Toggle-->
                <!--begin::User Menu Dropdown-->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img
                            src="{{url('/layout/imagens/users/'.auth()->user()->imagem)}}"
                            class="user-image rounded-circle shadow"
                            alt="User Image"
                        />
                        <span class="d-none d-md-inline">{{auth()->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <!--begin::User Image-->
                        <li class="user-header text-bg-primary">
                            <img
                                src="{{url('/layout/imagens/users/'.auth()->user()->imagem)}}"
                                class="rounded-circle shadow"
                                alt="User Image"
                            />
                            <p>
                                {{auth()->user()->nome_completo}}
                                <small>{{\Carbon\Carbon::parse(auth()->user()->created_at)->format('d/m/Y')}}</small>
                            </p>
                        </li>
                        <!--end::User Image-->
                        <!--begin::Menu Body-->
                        <li class="user-body">
                            <!--begin::Row-->
                            {{--<div class="row">
                                <div class="col-4 text-center"><a href="#">Followers</a></div>
                                <div class="col-4 text-center"><a href="#">Sales</a></div>
                                <div class="col-4 text-center"><a href="#">Friends</a></div>
                            </div>--}}
                            <!--end::Row-->
                        </li>
                        <!--end::Menu Body-->
                        <!--begin::Menu Footer-->
                        <form method="post" action="{{route('logout')}}">
                            @csrf
                        <li class="user-footer">
{{--                            <a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                            <button type="submit"  class="btn btn-default btn-flat float-end">Sair</button>
                            <a class="btn btn-default btn-flat float-md-left" href="{{route('usuario.mudar.senha')}}">Mudar Senha</a>
                        </li>
                        </form>
                        <!--end::Menu Footer-->
                    </ul>
                </li>
                <!--end::User Menu Dropdown-->
            </ul>
            <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
    </nav>
    <!--end::Header-->
    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <a href="../index.html" class="brand-link">
                <!--begin::Brand Image-->
                <img
                    src="../assets/img/AdminLTELogo.png"
                    alt="AdminLTE Logo"
                    class="brand-image opacity-75 shadow"
                />
                <!--end::Brand Image-->
                <!--begin::Brand Text-->
                <span class="brand-text fw-light">AdminLTE 4</span>
                <!--end::Brand Text-->
            </a>
            <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <!--begin::Sidebar Menu-->
                <ul
                    class="nav sidebar-menu flex-column"
                    data-lte-toggle="treeview"
                    role="navigation"
                    aria-label="Main navigation"
                    data-accordion="false"
                    id="navigation"
                >
                    <li class="nav-item">
                        <a href="{{route('dashboard.index')}}" class="nav-link">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    @can('usuario-lista')
                    <li class="nav-item">
                        <a href="{{route('usuario.index')}}" class="nav-link">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            <p>Usuários</p>
                        </a>
                    </li>
                    @endcan

                    @can('veiculo-lista')
                        <li class="nav-item">
                            <a href="{{route('veiculo.index')}}" class="nav-link">
                                <i class="fa fa-car" aria-hidden="true"></i>

                                <p>Veiculo</p>
                            </a>
                        </li>
                    @endcan
                    @can('montadora-lista')
                        <li class="nav-item">
                            <a href="{{route('montadora.index')}}" class="nav-link">
                                <i class="fa fa-car" aria-hidden="true"></i>

                                <p>Montadora</p>
                            </a>
                        </li>
                    @endcan
                    @can('modelos-lista')
                        <li class="nav-item">
                            <a href="{{route('modelo.index')}}" class="nav-link">
                                <i class="fa fa-car" aria-hidden="true"></i>

                                <p>Modelos</p>
                            </a>
                        </li>
                    @endcan

                    @can('contrato-lista')
                        <li class="nav-item">
                            <a href="{{route('contrato.index')}}" class="nav-link">
                                <i class="fa fa-id-card" aria-hidden="true"></i>


                                <p>Contratos</p>
                            </a>
                        </li>
                    @endcan
                    <li class="nav-header">SITE</li>
                    @can('banner-lista')
                        <li  class="nav-item">
                            <a href="{{route('banner.index')}}" class="nav-link">
                                <i class="fa fa-id-card" aria-hidden="true"></i>


                                <p>Banners</p>
                            </a>
                        </li>
                    @endcan
                    @can('categoria-lista')
                    <li  class="nav-item">
                        <a href="{{route('categoria.index')}}" class="nav-link">
                            <i class="fa fa-id-card" aria-hidden="true"></i>


                            <p>Categorias</p>
                        </a>
                    </li>
                    @endcan
                    @can('postagem-lista')
                        <li  class="nav-item">
                            <a href="{{route('postagem.index')}}" class="nav-link">
                                <i class="fa fa-id-card" aria-hidden="true"></i>


                                <p>Postagens</p>
                            </a>
                        </li>
                    @endcan

                    <li class="nav-header">CONFIGURAÇÃO</li>
                    @can('tipopagamento-lista')
                        <li  class="nav-item">
                            <a href="{{route('tipoPagamento.index')}}" class="nav-link">
                                <i class="fa fa-id-card" aria-hidden="true"></i>


                                <p>Tipo de Pagamentos</p>
                            </a>
                        </li>
                    @endcan
                    @can('grupo-lista')
                        <li class="nav-item">
                            <a href="{{route('grupo.index')}}" class="nav-link">
                                <i class="fa fa-cubes" aria-hidden="true"></i>

                                <p>Grupos</p>
                            </a>
                        </li>
                    @endcan



                </ul>
                <!--end::Sidebar Menu-->
            </nav>
        </div>
        <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">{{$titulo}}</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Docs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Layout</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                @include('admin.includes.alertas')
                @yield('conteudo')

            </div>
            <!-- /.container-fluid -->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
    <!--begin::Footer-->
    <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
            Copyright &copy; 2014-2025&nbsp;
            <a href="https://adminlte.io" class="text-decoration-none">Rafael Lima </a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
    </footer>
    <!--end::Footer-->
</div>
<!--end::App Wrapper-->
<!--begin::Script-->
<!--begin::Third Party Plugin(OverlayScrollbars)-->



<script src="{{ URL::asset('layout/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('layout/js/jquery-migrate.js') }}"></script>
<script src="{{ URL::asset('layout/plugins/colorpicker/jquery-asColor.js') }}"></script>
<script src="{{ URL::asset('layout/plugins/summernote/summernote-bs4.js') }}"></script>
<script src="{{ URL::asset('layout/plugins/jquery-multi-select/jquery.multi-select.js') }}"></script>
<script src="{{ URL::asset('layout/plugins/jquery-multi-select/jquery.quicksearch.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script src="{{ URL::asset('layout/plugins/mask/jquery.mask.js') }}"></script>

<script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"
></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->


<script src="{{ URL::asset('layout/plugins/select2/select2.full.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js"></script>

<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="{{ URL::asset('layout/js/adminlte.js') }}"></script>
<!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Fancybox.bind(document.getElementById("gallery-wrap"), "[data-fancybox]", {
            Carousel: {
                Thumbs: {
                    type: "classic",
                },
            },
        });
        $('.app-wrapper').on('keyup','.dinheiro',function () {
            $(this).mask("00000000.00" , { reverse:true});
        });
        $('.app-wrapper').on('keyup','.numero',function () {
            $(this).mask("00000000.00" , { reverse:true});
        });
        $('.app-wrapper').on('keyup','.caixa-alta',function () {
            this.value = this.value.toLocaleUpperCase();
        });
        $('.apenas-numeros').mask('0000000000', {reverse: true});
        $('.cep').mask('00000-000');


        $('.caixa-baixa').keyup(function() {
            this.value = this.value.toLocaleLowerCase();
        });
        $('.placa').mask('AAA0U00', {
            translation: {
                'A': {
                    pattern: /[A-Za-z]/
                },
                'U': {
                    pattern: /[A-Za-z0-9]/
                },
            },
            onKeyPress: function (value, e, field, options) {
                // Convert to uppercase
                e.currentTarget.value = value.toUpperCase();

                // Get only valid characters
                let val = value.replace(/[^\w]/g, '');

                // Detect plate format
                let isNumeric = !isNaN(parseFloat(val[4])) && isFinite(val[4]);
                let mask = 'AAA0U00';
                if(val.length > 4 && isNumeric) {
                    mask = 'AAA0000';
                }
                $(field).mask(mask, options);
            }
        });
        $('.botao-mudar-status').click(function(){
            var status      =   $(this).attr('status-id');

            $('#id-modal-status').val(status);
            $('#modal-mudar-status').modal("show")
        });
        $('#pesquisa-modelo').selectize();
        $('.datepicker').datepicker(
            {   dateFormat: "dd/mm/yy",
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                nextText: 'Próximo',
                prevText: 'Anterior'
            }
        );
        $('#summernote-contrato').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });


        $("#cadastrarVeiculoModal").submit(function () {



            var dados   = $(this).serialize();

            var rota    =   "{{route('veiculo.cadastrar')}}";

            $.ajax({
                type: "POST",
                url: rota,
                data: dados,
                success: function( data )
                {

                    if('error' in data){


                        $('#form-atualizavel-veiculo').html(data.form_veiculo)

                    }else{
                        console.log(data.form_veiculo)
                        var html    =   '<option value='+data.id+'>'+data.placa+'</option>'
                        $("#pesquisa-veiculo").html(html);
                        $('#formularioVeiculoModal').modal('hide');

                    }
                },
                error:function (data,e) {

                    alert(data);
                }
            });

            return false;
        });

        $(document).on("click", ".botao-atualizar-servico", function(e) {

            var id              =   $(this).attr("servico-id");
            var historico_id     =   $('#historico-id-'+id.toString()).val()
            var valor_bruto     =   $('#valor-bruto-'+id.toString()).val()
            var valor_liquido   =   $('#valor-liquido-'+id.toString()).val()
            var desconto        =   $('#desconto-'+id.toString()).val()
            var cobrar          =   $('#cobrar-'+id.toString()).val()
            var rota    =   "{{route('contrato.servico.atualizar')}}";



            $.ajax({
                header:{
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type: "POST",
                url: rota,
                data:{
                "valor_bruto":valor_bruto,
                "valor_liquido":valor_liquido,
                "desconto":desconto,
                "cobrar":cobrar,
                "servico_id":id,
                "historico_id":historico_id
                }
                ,
                success: function( data )
                {
                    console.log(data)
                    if('error' in data){

                        alert(data)


                    }else{

                        $("#tabela-servicos-atualizavel").html(data.tabela_servicos);
                    }
                },
                error:function (data,e) {
                    console.log(data)
                    alert(data);
                }
            });
            return false;

        });

        $(document).on("click", ".botao-atualizar-pecaavulsa", function(e) {
            var id              =   $(this).attr("peca-id");
            var historico_id     =   $('#historico-id-'+id.toString()).val()
            var marca           =   $('#peca-marca-'+id.toString()).val()
            var nome            =   $('#peca-nome-'+id.toString()).val()
            var valor_bruto     =   $('#peca-valor-bruto-'+id.toString()).val()
            var valor_liquido   =   $('#peca-valor-liquido-'+id.toString()).val()
            var desconto        =   $('#peca-desconto-'+id.toString()).val()
            var cobrar          =   $('#peca-cobrar-'+id.toString()).val()
            var qnt             =   $('#peca-qnt-'+id.toString()).val()
            var rota    =   "{{route('contrato.pecaavulsa.atualizar')}}";



            $.ajax({
                header:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: rota,
                data:{
                    "valor_bruto":valor_bruto,
                    "valor_liquido":valor_liquido,
                    "desconto":desconto,
                    "cobrar":cobrar,
                    "peca_id":id,
                    "historico_id":historico_id,
                    "marca":marca,
                    "qnt":qnt,
                    "nome":nome
                }
                ,
                success: function( data )
                {
                    console.log(data)
                    if('error' in data){

                        alert(data)


                    }else{

                        $("#tabela-pecas-avulsas-atualizavel").html(data.tabela_pecas_avulsas);

                    }
                },
                error:function (data,e) {
                    console.log(data)
                    alert(data);
                }
            });
            return false;

        });

        $(document).on("click", ".botao-exluir-pecaavulsa", function(e) {
            var id              =   $(this).attr("peca-id");
            var historico_id     =    $(this).attr("historico-id");
            var rota    =   "{{route('contrato.pecaavulsa.excluir')}}";



            $.ajax({
                header:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: rota,
                data:{
                    "peca_avulsa_id":id,
                    "historico_id":historico_id
                }
                ,
                success: function( data )
                {
                    console.log(data)
                    if('error' in data){

                        alert(data)


                    }else{

                        $("#tabela-pecas-avulsas-atualizavel").html(data.tabela_pecas_avulsas);
                    }
                },
                error:function (data,e) {
                    console.log(data)
                    alert(data);
                }
            });
            return false;

        });

        $(document).on("click", ".botao-exluir-servico", function(e) {
            var id              =   $(this).attr("servico-id");
            var historico_id     =    $(this).attr("historico-id");
            var rota    =   "{{route('contrato.servico.excluir')}}";



            $.ajax({
                header:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: rota,
                data:{
                    "servico_id":id,
                    "historico_id":historico_id
                }
                ,
                success: function( data )
                {
                    console.log(data)
                    if('error' in data){

                        alert(data)


                    }else{

                        $("#tabela-servicos-atualizavel").html(data.tabela_servicos);
                    }
                },
                error:function (data,e) {
                    console.log(data)
                    alert(data);
                }
            });
            return false;

        });

        $('#tabela-pecas-avulsas-atualizavel').on('keyup','.calcular-valors-peca',function () {
            console.log('deu');
            var peca_id         =   $(this).attr('peca_id');
            var valor_bruto     =   $('#peca-valor-bruto-'+peca_id).val();
            var qnt             =   $('#peca-qnt-'+peca_id).val();
            var valor_bruto_total   =   valor_bruto*qnt;
            var desconto        =   $('#peca-desconto-'+peca_id).val();
            var valor_liquido   =   $('#peca-valor-liquido-'+peca_id).val();
            var valor_liquido_total =   $('#valor-liquido-total-'+peca_id).val();


            if($(this).attr("ativo") == 'valor-bruto') {
                // $('#valor-total-peca-'+peca_id).val(parseFloat(valor_bruto_total).toFixed(2));
                $('#valor-liquido-total-'+peca_id).val(parseFloat(valor_bruto_total*((100-desconto)/100)).toFixed(2));
                $('#peca-valor-liquido-'+peca_id).val(parseFloat(valor_bruto*((100-desconto)/100)).toFixed(2));
            }else if($(this).attr("ativo") == 'qnt-peca'){
                $('#valor-total-peca-'+peca_id).val(parseFloat(valor_bruto_total).toFixed(2));
                $('#valor-liquido-total-'+peca_id).val(parseFloat(valor_bruto_total*((100-desconto)/100)).toFixed(2));
                $('#peca-valor-liquido-'+peca_id).val(parseFloat(valor_bruto*((100-desconto)/100)).toFixed(2));
            }else if($(this).attr("ativo") == 'desconto-peca'){
                $('#valor-liquido-total-'+peca_id).val(parseFloat(valor_bruto_total*((100-desconto)/100)).toFixed(2));
                $('#peca-valor-liquido-'+peca_id).val(parseFloat(valor_bruto*((100-desconto)/100)).toFixed(2));
            }else if($(this).attr("ativo") == 'valor-liquido-peca'){

                var desconto    =   parseFloat(100-((valor_liquido*100)/valor_bruto)).toFixed(2);

                if(desconto < 0){

                    $("#peca-desconto-"+peca_id).css("background-color", 'red').css('color','white');
                }else{
                    $("#peca-desconto-"+peca_id).css("background-color", 'white').css('color','#495057');
                }
                $('#valor-liquido-total-'+peca_id).val(valor_liquido*qnt);
                $("#peca-desconto-"+peca_id).val(desconto);
            }
        });



        $(document).on('keyup','.calcular-valors-servico',function (e){
            var id                  =   $(this).attr('servico_id');
            var valor_bruto         =   $('#valor-bruto-'+id).val();
            var desconto            =   $('#desconto-'+id).val();
            var valor_liquido       =   $('#valor-liquido-'+id).val();


            if($(this).attr("ativo") == 'valor-bruto'){
                $("#valor-liquido-"+id).val(parseFloat((valor_bruto*(100-desconto))/100).toFixed(2));
            }else if($(this).attr("ativo") == 'desconto'){

                $("#valor-liquido-"+id).val(parseFloat((valor_bruto*(100-desconto))/100).toFixed(2));
            }else if($(this).attr("ativo") == 'valor-liquido'){


                var desconto    =   parseFloat(100-((valor_liquido*100)/valor_bruto)).toFixed(2);

                if(desconto < 0){

                    $("#desconto-"+id).css("background-color", 'red').css('color','white');
                }else{
                    $("#desconto-"+id).css("background-color", 'white').css('color','#495057');
                }
                $("#desconto-"+id).val(desconto);
            }

            console.log(valor_bruto+" "+valor_liquido+" "+desconto);
        });

        $(document).on("submit", "#adicionar-servico", function(e) {
            e.preventDefault();

            var dados   = $(this).serialize();

            var rota    =   $(this).attr("action");


            $.ajax({
                type: "POST",
                url: rota,
                data: dados,
                success: function( data )
                {


                        console.log(data)
                        $("#tabela-servicos-atualizavel").html(data.tabela_servicos);

                },
                error:function (data,e) {

                    alert(data);
                }
            });

            return false;
        });

        $(document).on("submit", "#adicionar-peca-avulsa", function(e) {
            e.preventDefault();

            var dados   = $(this).serialize();

            var rota    =   $(this).attr("action");


            $.ajax({
                type: "POST",
                url: rota,
                data: dados,
                success: function( data )
                {

                    if('error' in data){

                        console.log(data.error)
                        $('#form-peca-avulsa').html(data.peca_html)

                    }else{
                        console.log(data)
                        $("#tabela-pecas-avulsas-atualizavel").html(data.tabela_pecas_avulsas);
                    }
                },
                error:function (data,e) {

                    alert(data);
                }
            });

            return false;
        });

        $("#cadastrarClienteModal").submit(function () {



            var dados   = $(this).serialize();

            var rota    =   "{{route('usuario.cadastrar')}}";

            $.ajax({
                type: "POST",
                url: rota,
                data: dados,
                success: function( data )
                {

                    if('error' in data){

                        $('#form-atualizavel-cliente').html(data.form_cliente)

                    }else{
                        console.log(data.form_cliente)
                        var html    =   '<option value='+data.id+'>'+data.name+'</option>'
                        $("#pesquisa-cliente").html(html);
                        $('#formularioClienteModal').modal('hide');

                    }
                },
                error:function (data,e) {

                    alert(data);
                }
            });

            return false;
        });
            $('#montadora-select2').select2({
                width: '100%',
                theme: 'bootstrap-5',
            })

            $("#pesquisa-veiculo").select2({
                width: '100%',
                theme: 'bootstrap-5',

                ajax: {
                    type: 'POST',
                    url: "{{route('veiculo.pesquisar.json')}}",
                    dataType: 'json',

                    beforeSend: function (xhr) {
                        var token = "{{csrf_token()}}";

                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    quietMillis: 400,
                    delay:400,
                    data: function (term, page) {

                        return {
                            q: term.term, //search term
                            // page size
                        };
                    },
                    processResults: function (data) {

                        return {
                            results: data
                        };
                    },
                },
                templateResult: function (data) {

                    var html    =   $('<div class="select2-user-result"><h5>'+data.modelo+" - "+data.placa+'</h5>' +
                        '<h6>Montadora: <b>'+data.montadora+'</b></h6>'+

                        '</div>'
                    );
                    return html;
                },
                templateSelection:function (data) {
                    var rota    =   "{{route('veiculo.editar',['veiculo'=>':id'])}}";
                    rota = rota.replace(':id',data.id);
                    $('#editar-veiculo').html(' <a class="btn btn-sm btn-warning"  href="'+rota+'" target="_new">Editar</a>');
                    var html    =   $('<div class="select2-user-result"><b>Veículo: </b>'+data.text+'</div><br>');
                    return html;
                },

            });

        $("#pesquisa-servico").select2({
            width: '100%',
            theme: 'bootstrap-5',

            ajax: {
                type: 'POST',
                url: "{{route('servico.pesquisar.json')}}",
                dataType: 'json',

                beforeSend: function (xhr) {
                    var token = "{{csrf_token()}}";

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                quietMillis: 400,
                delay:400,
                data: function (term, page) {

                    return {
                        q: term.term, //search term
                        // page size
                    };
                },
                processResults: function (data) {

                    return {
                        results: data
                    };
                },
            },
            templateResult: function (data) {

                var html    =   $('<div class="select2-user-result"><h5>'+data.nome+'</h5>' +


                    '</div>'
                );
                return html;
            },
            templateSelection:function (data) {
                $('#valor_servico').val(data.valor)
                var html    =   $('<div class="select2-user-result">'+data.text+'</div><br>');
                return html;
            },

        });


        $('.mult-select').multiSelect({
            selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"12\"'>",
            selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"4\"'>",
            afterInit: function(ms){
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if (e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if (e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function(){
                this.qs1.cache();
                this.qs2.cache();
            }
        });
        $('#selecionar-tudo-multi').click(function () {
            $('.mult-select').multiSelect('select_all');
            return false;
        });
        $('#deselecionar-tudo-multi').click(function () {
            $('.mult-select').multiSelect('deselect_all');
            return false;
        })



        $("#pesquisa-cliente").select2({
            width: '100%',
            theme: 'bootstrap-5',
            // placeholder: "Selecione um cliente",
            ajax: {
                type: 'POST',
                url: "{{route('cliente.pesquisar.json')}}",
                dataType: 'json',

                beforeSend: function (xhr) {
                    var token = '{{csrf_token()}}'

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                quietMillis: 400,
                delay:400,
                data: function (term, page) {

                    return {
                        q: term.term, //search term
                        // page size
                    };
                },
                processResults: function (data) {

                    return {
                        results: data
                    };
                },
            },
            templateResult: function (data) {

                var html    =   $('<div class="select2-user-result"><h5>'+data.nome+'</h5>' +
                    '<h6>Telefone: <b>'+data.telefone+'</b></h6>'+

                    '</div>'
                );
                return html;
            },
            templateSelection:function (data) {
                var rota    =   "{{route('usuario.editar',['usuario'=>':cliente','grupo_id'=>3])}}";
                rota = rota.replace(':cliente',data.id);

                $('#editar-cliente').html(' <a class="btn btn-sm btn-warning"  href="'+rota+'" target="_new">Editar</a>');
                var html    =   $('<div class="select2-user-result"><b>Cliente: </b>'+data.text+'</div><br>'
                );
                return html;
            },

        });
    });
</script>
<!--end::OverlayScrollbars Configure-->
<!--end::Script-->
</body>
<!--end::Body-->
</html>
