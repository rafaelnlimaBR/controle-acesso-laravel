<!DOCTYPE html>
<html lang="pt-br">
<title>{{$titulo}}</title>
<head>
    <meta charset="UTF-8">

    <style>

        @page{
            margin:20px;
        }

        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size:12px;
            background:#ffffff;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        td, th{
            padding:6px;
        }

        .borda td,
        .borda th{
            border:1px solid #000;
        }

        .section{
            font-weight:bold;
            border-bottom:2px solid #000;
            margin-top:20px;
            margin-bottom:8px;
        }

        .info td{
            border:none;
            padding:3px;
        }

        .assinaturas{
            margin-top:60px;
        }

        .linha-ass{
            border-top:1px solid #000;
            height:20px;
        }

    </style>

</head>
<body>



<!-- CABEÇALHO -->


<h2 style="text-align: center; border-bottom: 1px solid black">RECIBO</h2>
@include('admin.contratos.pdf.includes.cabecalho')



<!-- PAGAMENTOS -->

<div class="section">Pagamentos Realizados</div>

<table class="borda">

    <tr>
        <th width="150">Data</th>
        <th width="150">Forma de Pagamento</th>
        <th width="150">Valor</th>
    </tr>

    @foreach($contrato->historicos->map->entradas->flatten() as $entrada)
        <tr>
            <td>{{\Carbon\Carbon::parse($entrada->data)->format('d/m/Y')}}</td>
            <td>{{$entrada->taxa->tipo->nome.' - '.$entrada->taxa->nome}}</td>
            <td>R$ {{$entrada->valor_cliente}}</td>
        </tr>


    @endforeach

</table>



<!-- TOTAL -->
<table width="100%" style="margin-top:15px;">

    <tr>

        <td width="65%" valign="top">



            <p style="font-size: 15px; font-weight: bolder">
                Declaro que recebi do cliente acima identificado o valor referente aos serviços realizados na ordem de serviço mencionada.
            </p>

        </td>


        <td width="35%" valign="top">

            <div class="section">Pagamento</div>

            <table class="borda" width="100%">

                <tr>
                    <td>Total</td>
                    <td align="right">R$ 350,00</td>
                </tr>



            </table>

        </td>

    </tr>

</table>



<!-- ASSINATURA -->
{{--
<table class="assinaturas">

    <tr>

        <td width="50%" align="center">
            <div class="linha-ass"></div>
            Cliente
        </td>

        <td width="50%" align="center">
            <div class="linha-ass"></div>
            Responsável
        </td>

    </tr>

</table>--}}



</body>
</html>
