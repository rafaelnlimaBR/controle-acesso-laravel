@extends('admin.layout')

@section('conteudo')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-dark card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{request()->has('pagina')?request()->get('pagina')=='dados'?'active':'':'active'}}" id="custom-tabs-three-home-tab" data-toggle="pill" href="#dados" role="tab" aria-controls="custom-tabs-three-home" aria-selected="false">Dados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->has('pagina')?request()->get('pagina')=='historicos'?'active':'':''}}" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#historicos" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Historicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Messages</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane {{request()->has('pagina')?request()->get('pagina')=='dados'?'active show':'':'active show'}}" id="dados" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                        @include('admin.contratos.includes.dados')

                    </div>
                    <div class="tab-pane {{request()->has('pagina')?request()->get('pagina')=='historicos'?'active':'':''}}" id="historicos" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                    </div>

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

</div>
@endsection
