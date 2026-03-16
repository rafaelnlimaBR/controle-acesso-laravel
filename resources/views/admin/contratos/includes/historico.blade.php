<div class="row">
    <div class="col-md-8">
        <!-- The time line -->
        <div class="timeline">
            <!-- timeline time label -->
            <div class="time-label">
                <span class="text-bg-dark" >Aberto - {{\Carbon\Carbon::parse($contrato->data_inicio)->format('d/m/Y')}}</span>
                <span style="font-size:small ">{{isset($contrato->autor)?$contrato->autor->nome_completo:'Criado Online'}}</span>
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
                    <span style="font-size:small ">{{isset($h->autor)?$h->autor->nome_completo:'Criado Online'}}</span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                    @if($h->descricao != "")
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
                   @endif
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
                                        @foreach($registro->imagens as $imagem)

                                            <a
                                                href="{{url('/layout/imagens/registros/'.$imagem->nome)}}"
                                                data-fancybox="{{$registro->tipo->nome}}"
                                                data-caption="{{$imagem->descricao}}"
                                            >
                                                <img
                                                    src="{{url('/layout/imagens/registros/'.$imagem->nome)}}"
                                                    width="200"
                                                    height="150"
                                                    alt="{{$imagem->descricao}}"
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
        @include('admin.contratos.form.historico')
    </div>
</div>
