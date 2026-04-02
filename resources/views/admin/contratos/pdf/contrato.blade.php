<!DOCTYPE html>
<html lang="pt-br">
<title>{{$titulo}}</title>
<head>
    <meta charset="UTF-8">

    <style>

        @page {
            margin: 20px;
        }

        .body{
            font-family: Arial, Helvetica, sans-serif;
            font-size:12px;

        }

        .container{
            width:100%;
            background-color: white;
        }

        .topo{
            width:100%;
            margin-bottom:20px;
        }

        .topo td{
            vertical-align:top;
        }

        .empresa{
            font-size:18px;
            font-weight:bold;
        }

        .section{
            font-weight:bold;
            border-bottom:2px solid #000;
            margin-top:15px;
            margin-bottom:5px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        td, th{
            padding:5px;
        }

        .borda td, .borda th{
            border:1px solid #000;
        }

        .info td{
            border:none;
            padding:3px;
        }

        .assinaturas{
            margin-top:60px;
        }

        .assinaturas td{
            text-align:center;
        }

        .linha{
            border-top:1px solid #000;
            height:20px;
        }

    </style>

</head>
<body class="body">

<div class="container">
    @if($contrato->status->last()->id == $conf->orcamento_id)
        <h2 style="text-align: center; border-bottom: 1px solid black">ORÇAMENTO</h2>
    @else
        <h2 style="text-align: center; border-bottom: 1px solid black">ORDEM DE SERVIÇO</h2>
    @endif

    @include('admin.contratos.pdf.includes.cabecalho')


    <div class="section">Serviços Realizados</div>

    <table class="borda">
        <tr>
            @if($contrato->status->last()->cobrar == false)
                <th>Aut</th>
            @endif
            <th>Descrição</th>
            <th width="120">Valor</th>

        </tr>
        @foreach($contrato->historicos->map->servicos->flatten() as $servico)
            <tr>
                @if($contrato->status->last->cobrar == false)
                    <th>{{$servico->pivot->cobrar?"V":"X"}}</th>
                @endif
                <td>{{ $servico->nome}}</td>
                <td width="120">{{$servico->pivot->valor_liquido}}</td>
            </tr>
        @endforeach




    </table>



    <div class="section">Peças Utilizadas</div>

    <table class="borda">

        <tr>
            @if($contrato->status->last()->cobrar == false)
                <th>Aut</th>
            @endif
            <th>Peça</th>
            <th>Marca</th>
            <th width="60">Valor</th>
            <th width="30">Qtd</th>
            <th width="60">Total</th>
        </tr>
        @foreach($contrato->historicos->map->pecasAvulsas->flatten() as $peca)
            <tr>
                @if($contrato->status->last->cobrar == false)
                    <th>{{$servico->cobrar?"V":"X"}}</th>
                @endif
                <td>{{$peca->nome}}</td>
                <td>{{$peca->marca}}</td>
                <td>{{$peca->valor_liquido}}</td>
                <td>{{$peca->qnt}}</td>
                <td>{{$peca->valor_liquido * $peca->qnt}}</td>
            </tr>
        @endforeach



    </table>



    <table width="100%" style="margin-top:15px;">

        <tr>

            <td width="65%" valign="top">
                @if($contrato->status->last()->id == $conf->orcamento_id)
                <div class="section">Observações</div>

                <p>
                    Garantia de 90 dias a partir autorização do orçamento
                </p>
                @endif
            </td>


            <td width="35%" valign="top">

                <div class="section">Total</div>

                <table class="borda" width="100%">
                    @if($contrato->status->last()->id == $conf->orcamento_id or $contrato->status->last()->id == $conf->orcamento_online_id)
                    <tr>
                        <td>Serviços</td>
                        <td align="right">R$ {{$contrato->valorLiquidoTotalServico()}}</td>
                    </tr>

                    <tr>
                        <td>Peças</td>
                        <td align="right">R$ {{$contrato->valorLiquidoTotalPecaAvulsa()}}</td>
                    </tr>

                    <tr>
                        <td><b>Total</b></td>
                        <td align="right"><b>R$ {{$contrato->valorLiquidoTotalServico()+$contrato->valorLiquidoTotalPecaAvulsa()}}</b></td>
                    </tr>
                    @else

                        <tr>
                            <td>Serviços</td>
                            <td align="right">R$ {{$contrato->valorLiquidoTotalAutorizadoServico()}}</td>
                        </tr>

                        <tr>
                            <td>Peças</td>
                            <td align="right">R$ {{$contrato->valorLiquidoTotalAutorizadoPecaAvulsa()}}</td>
                        </tr>

                        <tr>
                            <td><b>Total</b></td>
                            <td align="right"><b>R$ {{$contrato->valorLiquidoTotalAutorizadoPecaAvulsa()+$contrato->valorLiquidoTotalAutorizadoServico()}}</b></td>
                        </tr>
                    @endif
                </table>

            </td>

        </tr>

    </table>


    @if($contrato->status->last()->id == $conf->orcamento_id)
    <table class="assinaturas" width="100%">

        <tr>

            <td width="50%">
                <div class="linha"></div>
                ORÇAMENTO VÁLIDO POR 48 HORAS
            </td>



        </tr>

    </table>
    @elseif($contrato->status->last()->id == $conf->nao_autorizado_id)


    @elseif($contrato->status->last()->id == $conf->cancelado_id)

        @endif

</div>

</body>
</html>
