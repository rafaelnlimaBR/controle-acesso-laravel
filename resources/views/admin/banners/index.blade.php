@extends('admin.layout')

@section('conteudo')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
            <div class="card-header"><h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> Pesquisa </h3></div>
            <!-- /.card-header -->
            <div class="card-body">
                <form  action="{{route('banner.index')}}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label  class="form-label">Nome<span class="sr-only"> </span></label>
                            <input type="text" class="form-control" name="nome"  value="{{request()->has('nome')?request()->get('nome'):""}}">


                        </div>

                        <div class="col-md-1 ">
                            <label  class="form-label">Pesquisar<span class="sr-only"> </span></label>
                            <button type="submit" class="form-control btn btn-primary"   ><i class="bi bi-search"></i></button>


                        </div>


                    </div>
                </form>

            </div>
            <!-- /.card-body -->

        </div>

        <div class="card mb-5">
            <div class="card-header"><h3 class="card-title"><i class="bi bi-database"></i> {{$titulo_tabela}} </h3>
                <div class="card-tools">
                    @can('banner-criar')
                    <a class="btn btn-sm btn-primary" href="{{route('banner.novo')}}"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
                    @endcan
                </div></div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" role="table">
                    <thead>
                    <tr>
                        <th style="width: 10px" scope="col">#</th>
                        <th style="width: 20%" scope="col">Imagem</th>
                        <th scope="col">Nome</th>

                        <th style="width: 5%" scope="col">Ações</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($banners as $banner)
                        <tr class="align-middle">
                            <td>{{$banner->id}}</td>
                            <td><img style="height: 40px" src="{{url('images/banners/'.$banner->imagem)}}"></td>

                            <td>{{$banner->titulo}}</td>

                            <td>
                                @can('banner-visualizar')
                                <a title="detalhar" href=""><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                </a>
                                @endcan
                                @can('banner-editar')
                                <a href="{{route('banner.editar',['banner'=>$banner])}}" class="text-decoration-none">
                                    <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                </a>
                                @endcan
                            </td>


                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{$banners->links()}}
            </div>
        </div>
        <!-- /.card -->

        <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
</div>
@stop
