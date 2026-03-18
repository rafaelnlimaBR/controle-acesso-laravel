@extends('admin.layout')
@section('conteudo')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{request()->has('pagina')?request()->get('pagina')=='postagem'?'active':'':'active'}}" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Postagem</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{request()->has('pagina')?request()->get('pagina')=='imagens'?'active':'':''}}" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Imagens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->has('pagina')?request()->get('pagina')=='comentarios'?'active':'':''}}" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Comentários</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade {{request()->has('pagina')?request()->get('pagina')=='postagem'?'active show':'':'active show'}}" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        @include('admin.postagens.includes.postagem')
                    </div>
                    @if(isset($postagem))
                    <div class="tab-pane {{request()->has('pagina')?request()->get('pagina')=='imagens'?'active show':'':''}}" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        @include('admin.postagens.includes.imagem')
                    </div>
                    <div class="tab-pane {{request()->has('pagina')?request()->get('pagina')=='comentarios'?'active show':'':''}}" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                        @include('admin.postagens.includes.comentario')
                    </div>

                    @endif

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

</div>

@stop
