@extends('admin.layout')

@section('conteudo')

<div class="row">
    <div class="col-12">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> AdminLTE, Inc.
                        <small class="float-right">Data: {{\Carbon\Carbon::now()->format('d/m/Y ')}}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">

                    <address>
                        <strong>Tecvel</strong><br>
                        Rua Pinto Madeira, 750 - Centro<br>
                        Fortaleza - Ceará<br>
                        Whatsapp: (85) 987067785<br>
                        Email: rafael@tecvelautomotiva.com.br
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                    <address>
                        <strong>{{$contrato->cliente->name}}</strong><br>
                        Contatos: {{$contrato->cliente->contatos->pluck('numero')->join(', ')}}<br>
                        @if($contrato->veiculo != null)
                            Veículo: {{$contrato->veiculo->modelo->nome }}<br>
                            Montadora: {{$contrato->veiculo->modelo->montadora->nome }}<br>
                            Placa: {{$contrato->veiculo->placa}}<br>

                        @endif

                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                    <b>Ordem ID:</b> {{$contrato->id}}<br>
                    <b>Data de início:</b> {{\Carbon\Carbon::parse($contrato->data_inicio)->format('d/m/Y ')}}<br>
{{--                    <b>Account:</b> 968-34567--}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            @if($contrato->historicos->map->servicos->count() >= 1)
                <h5 style="border-top: 1px solid #d3d6d2; padding-top: 5px">Serviços</h5>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Valor</th>
                            {{--<th>Serial #</th>
                            <th>Description</th>
                            <th>Subtotal</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contrato->historicos->map->servicos->flatten() as $servico)
                            <tr>
                                <td>{{$servico->nome}}</td>
                                <td>{{$servico->pivot->valor_liquido   }}</td>

                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            @endif
            <!-- /.row -->

            <!-- Table row -->
            @if($contrato->historicos->map->pecasavulsas->count() >= 1)
                <h5 style="border-top: 1px solid #d3d6d2; padding-top: 5px">Peças</h5>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Valor</th>
                                {{--<th>Serial #</th>
                                <th>Description</th>
                                <th>Subtotal</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contrato->historicos->map->pecasAvulsas->flatten() as $peca)
                                <tr>
                                    <td>{{$peca->nome}}</td>
                                    <td>{{$peca->valor_liquido   }}</td>

                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
            @endif


                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                        <p class="lead">Payment Methods:</p>
                        <img src="../../dist/img/credit/visa.png" alt="Visa">
                        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                        <img src="../../dist/img/credit/american-express.png" alt="American Express">
                        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                            plugg
                            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <p class="lead">Amount Due 2/22/2014</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody><tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>$250.30</td>
                                </tr>
                                <tr>
                                    <th>Tax (9.3%)</th>
                                    <td>$10.34</td>
                                </tr>
                                <tr>
                                    <th>Shipping:</th>
                                    <td>$5.80</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>$265.24</td>
                                </tr>
                                </tbody></table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                        Payment
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </button>
                </div>
            </div>
        </div>
        <!-- /.invoice -->
    </div><!-- /.col -->
</div>
@endsection
