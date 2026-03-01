
    <div class="row " id="formulario-entradas">
        <div class="col-md-5">
            <!--begin::Different Height-->
            <div class="card card-secondary card-outline mb-4">
                <!--begin::Header-->
                <div class="card-header"><div class="card-title">{{$titulo_card. ' - '.$tipo->nome}}</div></div>
                <!--end::Header-->
                <!--begin::Body-->

                <form class="needs-validation" novalidate="" method="post" action="{{isset($veiculo)?route('veiculo.atualizar',['veiculo'=>$veiculo]):route('veiculo.cadastrar')}}">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-8">
                                <label  class="form-label">Descricao<span class="sr-only"> </span></label>
                                <input type="text" class="form-control" name="descricao" value="{{isset($descricao)?$descricao:old('descricao',isset($entrada)?$entrada->descricao:'')}}" >
                                @error('descricao')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label  class="form-label">Data<span class="sr-only"> </span></label>
                                <input type="text" class="form-control" name="data" value="{{isset($data)?$data:old('data',isset($entrada)?$entrada->data:'')}}" >
                                @error('data')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3">
                            <!--begin::Col-->
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" data-gtm-form-interact-field-id="0">
                                    <label class="form-check-label" for="exampleCheck1">Repassar Taxa</label>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label  class="form-label">Valor<span class="sr-only"> </span></label>
                                <input type="text" class="form-control" id="valor_liquido" name="valor_liquido" value="{{isset($valor)?$valor:old('valor',isset($entrada)?$entrada->valor:'')}}" >
                                @error('valor_liquido')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label  class="form-label">Formas<span class="sr-only"> </span></label>
                                <select name="forma" class="form-control" id="select-forma-entrada">
                                    @foreach($tipo->taxas as $taxa)
                                        <option value="{{$taxa->id}}">{{$taxa->nome}}</option>
                                    @endforeach
                                </select>
                                @error('forma')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
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

                        <a href="{{route('contrato.editar',['contrato'=>$contrato,'historico'=>$historico_selecionado,'pagina'=>'pagamentos'])}}" class="btn btn-dark" type="submit">Voltar </a>
                    </div>
                </form>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-md-7" id="pagina-atualizavel-entrada">

        </div>

    </div>
<script type="text/javascript">
    $(document).ready(function (e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        renderizarPagina($('#select-forma-entrada').val(),$('#valor_liquido').val())

        $('#select-forma-entrada').on('change',function (e){
            id      =   $(this).val();
            valor   =   $('#valor_liquido').val();
            renderizarPagina(id,valor)
        });

        $('#valor_liquido').blur(function(){
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


