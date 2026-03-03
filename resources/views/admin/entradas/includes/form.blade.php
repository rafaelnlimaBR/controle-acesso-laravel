
    <div class="row " id="formulario-entradas">
        <div class="col-md-7">
            <!--begin::Different Height-->
            <div class="card card-secondary card-outline mb-4">
                <!--begin::Header-->
                <div class="card-header"><div class="card-title">{{$titulo_card. ' - '.$tipo->nome}}</div></div>
                <!--end::Header-->
                <!--begin::Body-->

                <form class="needs-validation" novalidate="" method="post" action="{{route('entrada.gravar')}}">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-8">
                                <label  class="form-label">Descricao<span class="sr-only" > </span></label>
                                <input type="text" class="form-control" name="descricao" value="{{isset($descricao)?$descricao:old('descricao',isset($entrada)?$entrada->descricao:$descricao)}}" >
                                @error('descricao')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label  class="form-label">Data<span class="sr-only"> </span></label>
                                <input type="text" class="form-control datepicker" autocomplete="off" name="data" value="{{isset($data)?$data:old('data',isset($entrada)?$entrada->data:\Carbon\Carbon::now()->format('d/m/Y'))}}" >
                                @error('data')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3">
                            <!--begin::Col-->
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" checked class="form-check-input"  name="rapassar_taxa" data-gtm-form-interact-field-id="0">
                                    <label class="form-check-label" for="exampleCheck1">Repassar Taxa</label>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label  class="form-label">Valor<span class="sr-only"> </span></label>
                                <input type="text" class="form-control" id="valor_original" name="valor_original" value="{{isset($valor_original)?$valor_original:old('valor_original',isset($entrada)?$entrada->valor_original:$valor_original)}}" >
                                @error('valor_original')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label  class="form-label">Formas<span class="sr-only"> </span></label>
                                <select name="taxa_id" class="form-control" id="select-forma-entrada">
                                    @foreach($tipo->taxas as $taxa)
                                        <option value="{{$taxa->id}}">{{$taxa->nome}}</option>
                                    @endforeach
                                </select>
                                @error('forma')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label  class="form-label">Taxa<span class="sr-only"> </span></label>
                                <input readonly type="text" class="form-control" id="valor_taxa" name="taxa" value="" >
                            </div>
                            <div class="col-md-2">
                                <label  class="form-label">Valor Cliente<span class="sr-only"> </span></label>
                                <input readonly type="text" class="form-control" id="valor_cliente" name="valor_original" value="{{isset($valor_original)?$valor_original:old('valor_original',isset($entrada)?$entrada->valor_original:$valor_original)}}" >
                                @error('valor_original')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label  class="form-label">Parcela<span class="sr-only"> </span></label>
                                <input readonly type="text" class="form-control" id="parcela" name="parcela" value="" >

                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        @if(isset($veiculo))
                            <button class="btn btn-warning" type="submit">Editar</button>
                            @can('veiculo-deletar')
                                <a href="{{route('veiculo.excluir',['veiculo'=>$veiculo])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
                            @endcan
                        @else
                            <button class="btn btn-success" type="submit">Cadastrar</button>
                        @endif

                        <a href="{{$route_back}}" class="btn btn-dark" type="submit">Voltar </a>
                    </div>
                </form>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-md-5" id="pagina-atualizavel-entrada">
            @if($tipo->pix)
                @include('admin.entradas.includes.qrcode')
            @else
                @include('admin.entradas.includes.detalhes')
            @endif
        </div>

    </div>
    @if($tipo->pix)
        <script type="text/javascript">
            $(document).ready(function (e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                renderizarPagina($('#select-forma-entrada').val(),$('#valor_original').val())

                $('#select-forma-entrada').on('change',function (e){
                    id      =   $(this).val();
                    valor   =   $('#valor_original').val();
                    renderizarPagina(id,valor)
                });

                $('#valor_bruto').blur(function(){
                    id      =   $('#select-forma-entrada').val();
                    valor   =   $(this).val();
                    renderizarPagina(id,valor)
                });

                function renderizarPagina(taxa_id,valor){
                    var rota    =   "{{route('taxa.rendereizar.pagina')}}";


                    $.ajax({
                        type: "POST",
                        url: rota,
                        data: {
                            'taxa_id':taxa_id,
                            'valor':valor
                        },
                        success: function( data )
                        {

                            if('error' in data){

                                alert(data.error)


                            }else{
                                console.log(data)
                                $('#pagina-atualizavel-entrada').html(data.pagina);

                            }
                        },
                        error:function (data,e) {

                            console.log(data)
                        }
                    });
                }


            })
        </script>
    @endif
        <script type="text/javascript">
            $(document).ready(function (e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                pegarValorTaxa();


                $('#select-forma-entrada').change(function (e){
                    pegarValorTaxa()
                })

                function calcularValores(){
                    var valor_original      =   $('#valor_original').val();
                    var valor_cliente       =   $('#valor_original').val();
                    var valor_taxa          =   $('#valor_taxa').val();

                }

                function pegarValorTaxa(){
                    var rota    =   "{{route('taxa.pegar.valor.taxa')}}";
                    var taxa_id =   $('#select-forma-entrada').val();


                    $.ajax({
                        type: "POST",
                        url: rota,
                        data: {
                            'taxa_id':taxa_id
                        },
                        success: function( data )
                        {
                            $('#valor_taxa').val(data);

                            return data;
                        },
                        error:function (data,e) {

                            console.log(data)
                        }
                    });
                }
            });
        </script>



