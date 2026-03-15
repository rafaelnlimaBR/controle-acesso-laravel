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
            <th>Descrição</th>
            <th width="120">Valor</th>
        </tr>

        <tr>
            <td>Aferição de painel de instrumentos</td>
            <td>R$ 150,00</td>
        </tr>

        <tr>
            <td>Reparo no marcador de velocidade</td>
            <td>R$ 200,00</td>
        </tr>

    </table>



    <div class="section">Peças Utilizadas</div>

    <table class="borda">

        <tr>
            <th>Peça</th>
            <th width="60">Qtd</th>
            <th width="120">Valor</th>
        </tr>

        <tr>
            <td>Sensor de velocidade</td>
            <td>1</td>
            <td>R$ 120,00</td>
        </tr>

        <tr>
            <td>Resistor eletrônico</td>
            <td>2</td>
            <td>R$ 10,00</td>
        </tr>

    </table>



    <table width="100%" style="margin-top:15px;">

        <tr>

            <td width="65%" valign="top">

                <div class="section">Observações</div>

                <p>
                    Realizado reparo no painel e aferição do marcador de velocidade para garantir leitura correta.
                    Sistema testado e funcionando normalmente.
                </p>

            </td>


            <td width="35%" valign="top">

                <div class="section">Pagamento</div>

                <table class="borda" width="100%">

                    <tr>
                        <td>Serviços</td>
                        <td align="right">R$ 350,00</td>
                    </tr>

                    <tr>
                        <td>Peças</td>
                        <td align="right">R$ 130,00</td>
                    </tr>

                    <tr>
                        <td><b>Total</b></td>
                        <td align="right"><b>R$ 480,00</b></td>
                    </tr>

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

        @endif


</div>

</body>
</html>
