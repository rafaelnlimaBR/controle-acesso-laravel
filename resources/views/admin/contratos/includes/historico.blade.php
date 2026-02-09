<div class="row">
    <div class="col-md-8">
        <!-- The time line -->
        <div class="timeline">
            <!-- timeline time label -->
            <div class="time-label">
                <span class="text-bg-dark" >Aberto - {{\Carbon\Carbon::parse($contrato->data_inicio)->format('d/m/Y')}}</span>
                <span style="font-size:small ">{{$contrato->autor->nome_completo}}</span>
            </div>
            <div>
                <i class="timeline-icon  bi-chat-dots text-bg-primary"> </i>
                <div class="timeline-item">
                    <span class="time"> <i class="bi bi-clock-fill"></i> {{\Carbon\Carbon::parse($contrato->data)->format('H:i')}} </span>
                    <h3 class="timeline-header">
                        Descrição do problema
                    </h3>

                    <div class="timeline-body">
                        {{$contrato->descricao_cliente}}
                    </div>
{{--                    <div class="timeline-footer">--}}
{{--                        <a class="btn btn-warning btn-sm">Editar</a>--}}

{{--                    </div>--}}
                </div>
            </div>
            @foreach($contrato->historicos as $h)

                <div class="time-label">
                    <span class="" style="color: {{'#'.$h->status->cor_letra}}; background-color:{{'#'.$h->status->cor_fundo}} "><a style="color: {{'#'.$h->status->cor_letra}}; text-decoration: none" href="{{route('contrato.editar',['contrato'=>$contrato,'historico'=>$h,'pagina'=>'historicos'])}}">{{$h->status->nome ." - ".\Carbon\Carbon::parse($h->data)->format('d/m/Y')}}</a></span>
                    <span style="font-size:small ">{{$h->autor->nome_completo}}</span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->

                    <div>
                        <i class="timeline-icon bi bi-card-list text-bg-primary"> </i>
                        <div class="timeline-item">
                            <span class="time"> <i class="bi bi-clock-fill"></i> {{\Carbon\Carbon::parse($h->data)->format('H:i')}} </span>
                            <h3 class="timeline-header">
                                Observação
                            </h3>

                            <div class="timeline-body">
                                {{$h->descricao}}
                            </div>
                            {{--<div class="timeline-footer">
                                <a class="btn btn-warning btn-sm">Editar</a>

                            </div>--}}
                        </div>
                    </div>

                    @if($h->registros()->exists())
                        @foreach($h->registros as $registro)
                        <div>
                            <i class="timeline-icon {{$registro->tipo->icon}} text-bg-primary"> </i>

                            <div class="timeline-item">
                                <span class="time"> <i class="bi bi-clock-fill"></i> {{\Carbon\Carbon::parse($h->data)->format('H:i')}} </span>
                                <h3 class="timeline-header">
                                    {{$registro->tipo->nome}}
                                </h3>

                                <div class="timeline-body">
                                    {{$registro->descricao}}
                                </div>
                                @if($registro->imagens()->exists())
                                    <div class="timeline-footer">
                                        @foreach($registro->imagens as $imagens)

                                            <a
                                                href="{{url('/layout/imagens/users/'.$imagens->nome)}}"
                                                data-fancybox="{{$registro->tipo->nome}}"
                                                data-caption="Optional caption,&lt;br /&gt;that can contain &lt;em&gt;HTML&lt;/em&gt; code"
                                            >
                                                <img
                                                    src="{{url('/layout/imagens/users/'.$imagens->nome)}}"
                                                    width="200"
                                                    height="150"
                                                    alt="Sample image #1"
                                                />
                                            </a>



                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div>
                        @endforeach

                    @endif



                <!-- END timeline item -->
                <!-- timeline item -->
                {{--<div>
                    <i class="timeline-icon bi bi-person text-bg-success"> </i>
                    <div class="timeline-item">
                        <span class="time"> <i class="bi bi-clock-fill"></i> 5 mins ago </span>
                        <h3 class="timeline-header no-border">
                            <a href="#">Sarah Young</a> accepted your friend request
                        </h3>
                    </div>
                </div>
                <!-- END timeline item -->
                <!-- timeline item -->
                <div>
                    <i class="timeline-icon bi bi-chat-text-fill text-bg-warning"> </i>
                    <div class="timeline-item">
                        <span class="time"> <i class="bi bi-clock-fill"></i> 27 mins ago </span>
                        <h3 class="timeline-header">
                            <a href="#">Jay White</a> commented on your post
                        </h3>
                        <div class="timeline-body">
                            Take me to your leader! Switzerland is small and neutral! We are more like
                            Germany, ambitious and misunderstood!
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-warning btn-sm">View comment</a>
                        </div>
                    </div>
                </div>--}}

            @endforeach

            <!-- END timeline item -->
            <!-- timeline time label -->

            <!-- END timeline item -->
            <div>
                <i class="timeline-icon bi bi-clock-fill text-bg-secondary"> </i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <form method="post" action="{{route('contrato.editar.historico',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}">
            {{csrf_field()}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">Editar Historico - {{$historico_selecionado->status->nome}}</div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!--begin::Col-->
                    <div class="col-md-12">
                        <label  class="form-label">Descrição<span class="sr-only"> </span></label>
                        <textarea class="form-control" name="descricao" >{{$historico_selecionado->descricao}}</textarea>
                    </div>
                </div>
                <div class="row g-3">
                    <!--begin::Col-->
                    <div class="col-md-4">
                        <label  class="form-label">Data<span class="sr-only"> </span></label>
                        <input type="text" class="form-control datepicker" name="data" value="{{\Carbon\Carbon::parse($historico_selecionado->data)->format('d/m/Y')}}" >
                        @error('data')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button  class="btn btn-warning" type="submit">Editar</button>
            </div>
        </div>
        </form>
    </div>
</div>
