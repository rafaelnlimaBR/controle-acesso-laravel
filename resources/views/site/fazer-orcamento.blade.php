
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Solicitação de Orçamento</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <style>

        .veiculo-area{
            display:none;
            background:#f8f9fa;
            padding:20px;
            border-radius:5px;
            margin-top:15px;
            border:1px solid #ddd;
        }

    </style>

</head>

<body>

<div class="container mt-5">
    @if(session()->has('alerta'))
        <div class="alert alert-{{Session::get('alerta')['tipo'] }} alert-dismissible fade show" role="alert">
            {{Session::get('alerta')['texto'] }}<ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card shadow">


        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Solicitação de Orçamento</h4>
        </div>

        <div class="card-body">

            <form method="POST" class="needs-validation"  action="{{route('site.cadastrar.orcamento')}}" enctype="multipart/form-data">

                <h5 class="mb-3">Dados do Cliente</h5>

                <div class="row">
                    {{csrf_field()}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">Nome *</label>
                        <input type="text" class="form-control  @error('nome')is-invalid @enderror" name="nome" value="{{old('nome',request('nome',''))}}">
                        @error('nome')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror

                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email *</label>
                        <input type="text" class="form-control @error('email')is-invalid @enderror" name="email" value="{{old('email')}}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Whatsapp * ex: (85) 987067785</label>
                        <input type="text" class="form-control @error('contato')is-invalid @enderror" name="contato" id="numero-contato" value="{{old('contato',request('whatsapp',''))}}">
                        @error('contato')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                </div>


                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox"  {{old('cadastrar_veiculo')=='on'?'checked':''}}  name="cadastrar_veiculo" id="temVeiculo">
                    <label class="form-check-label">
                        Cadastrar veículo
                    </label>
                </div>


                <div class="veiculo-area" id="formVeiculo">

                    <h5 class="mt-2 mb-3">Dados do Veículo</h5>

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Placa *</label>
                            <input type="text" class="form-control @error('placa')is-invalid @enderror" name="placa" value="{{old('placa')}}">
                            @error('placa')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror

                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Ano *</label>
                            <input type="number" class="form-control @error('ano')is-invalid @enderror" name="ano" value="{{old('ano')}}">
                            @error('ano')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Montadora *</label>
                            <select  class="form-control @error('montadora')is-invalid @enderror" name="montadora" id="montadoras">
{{--                                <option value="0">Selecione uma montadora</option>--}}
                                @foreach($montadoras as $montadora)

                                    @if(old('montadora')== $montadora->id)
                                        <option value="{{$montadora->id}}" selected>{{$montadora->nome}}</option>
                                    @else
                                        <option value="{{$montadora->id}}">{{$montadora->nome}}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('montadora')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="form-label">Modelo *</label>

                            <select class="form-control @error('modelo')is-invalid @enderror" name="modelo" id="modelos">

                                @if(session()->has('modelos_retorno'))

                                    @foreach(session()->get('modelos_retorno') as $modeloo)
                                        @if($modeloo->id == old('modelo',0))
                                            <option selected value="{{$modeloo->id}}">{{$modeloo->nome}}</option>
                                        @else
                                            <option  value="{{$modeloo->id}}">{{$modeloo->nome}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>

                            @error('modelo')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>



                    </div>

                </div>


                <div class="mt-4">

                    <label class="form-label">Descreva o problema *</label>

                    <textarea
                        class="form-control @error('descricao')is-invalid @enderror"
                        rows="5"
                        name="descricao"
                        placeholder="Descreva o que está acontecendo com o veículo..."
                    >{{old('descricao')}}</textarea>
                    @error('descricao')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>


                <div class="mt-3">

                    <label class="form-label">Envie algumas imagens para demonstrar o defeito</label>

                    <input
                        type="file"
                        class="form-control"
                        name="imagens[]"
                        multiple
                        accept="image/*"
                        capture="environment"
                    >

                </div>
                <div class="card-footer" style="margin: 10px">
                    <H5 CLASS="text-center">A SOLICITAÇÃO SERÁ ANALISADA E O ORÇAMENTO SERÁ ENVIADO PARA SEU WHATSAPP O MAIS BREVE POSSÍVEL.</H5>
                </div>

                <div class="text-center  mt-4">

                    <button type="submit" class="btn btn-success shadow">
                        Enviar Solicitação de Orçamento
                    </button>

                </div>

            </form>

        </div>

    </div>


</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{url()->asset('layout/plugins/mask/jquery.mask.js')}}"></script>
<script>
    $(document).ready(function (){

        verificarCheckBoxVeiculo();
        // atulaizarModelos();
        $('#temVeiculo').change(function(){

            verificarCheckBoxVeiculo();

        });

        var behavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            options = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(behavior.apply({}, arguments), options);
                }
            };

        $('#numero-contato').mask(behavior, options);

        $('#montadoras').select2(
            {
                theme: 'bootstrap-5'
            }
        );
        $('#modelos').select2(
            {
                theme: 'bootstrap-5'
            }
        );

        function verificarCheckBoxVeiculo(){

            if($('#temVeiculo').is(':checked')){
                $('#formVeiculo').slideDown();
            }else{
                $('#formVeiculo').slideUp();
            }

        }
        function atulaizarModelos(){
            id  =   $('#montadoras').val();
            rota    =   "{{route('montadora.modelos.ajax',['id'=>':id'])}}".replace(':id',id);
            modelos = $('#modelos');

            modelos.empty();
            $.get(rota, function (data){
                $.each(data.modelos, function(i, item) {
                    modelos.append($('<option>', {
                        value: item.id,
                        text : item.nome
                    }));
                });
            });
        }
        $('#montadoras').change(function (){
            console.log('de');
            atulaizarModelos();
        });
    });

</script>

</body>
</html>
```
