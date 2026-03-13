<!DOCTYPE html>
<html lang="pt-br">
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

    <table width="100%" style="margin-bottom:20px;" class="topo">

        <tr>

            <!-- LOGO -->
            <td width="20%" valign="top">
                <img src="logo.png" style="width:100px;">
            </td>


            <!-- DADOS DA EMPRESA -->
            <td width="50%" valign="top">

                <b style="font-size:16px;">TECVEL ELETRÔNICA AUTOMOTIVA</b><br>
                CNPJ: 28.727.291/0001-33<br>
                Rua Pinto Madeira, 750 - Centro<br>
                CEP: 60150-000<br>
                Telefone: (85) 99999-9999

            </td>


            <!-- DADOS DA OS -->
            <td width="30%" valign="top" align="right">

                <table width="100%" class="borda" style="font-size:11px;">

                    <tr>
                        <td><b>Ordem Nº</b></td>
                        <td align="right">000123</td>
                    </tr>

                    <tr>
                        <td><b>Data</b></td>
                        <td align="right">13/03/2026</td>
                    </tr>

                    <tr>
                        <td><b>Status</b></td>
                        <td align="right">Concluído</td>
                    </tr>

                </table>

            </td>

        </tr>

    </table>


    <table width="100%">

        <tr>

            <td width="50%" valign="top">

                <div class="section">Cliente</div>

                <table class="info">

                    <tr>
                        <td><b>Nome:</b></td>
                        <td>José Austregesilo</td>
                    </tr>

                    <tr>
                        <td><b>Telefone:</b></td>
                        <td>(85) 99999-9999</td>
                    </tr>

                    <tr>
                        <td><b>CPF:</b></td>
                        <td>123.456.789-00</td>
                    </tr>

                    <tr>
                        <td><b>Endereço:</b></td>
                        <td>Rua das Flores, 100 - Fortaleza</td>
                    </tr>

                </table>

            </td>


            <td width="50%" valign="top">

                <div class="section">Veículo</div>

                <table class="info">

                    <tr>
                        <td><b>Placa:</b></td>
                        <td>ABC1D23</td>
                    </tr>

                    <tr>
                        <td><b>Marca:</b></td>
                        <td>Volkswagen</td>
                    </tr>

                    <tr>
                        <td><b>Modelo:</b></td>
                        <td>Gol</td>
                    </tr>

                    <tr>
                        <td><b>Ano:</b></td>
                        <td>2018</td>
                    </tr>

                    <tr>
                        <td><b>KM:</b></td>
                        <td>85.000</td>
                    </tr>

                </table>

            </td>

        </tr>

    </table>


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



    <table class="assinaturas" width="100%">

        <tr>

            <td width="50%">
                <div class="linha"></div>
                ORÇAMENTO VÁLIDO POR 48 HORAS
            </td>



        </tr>

    </table>

</div>

</body>
</html>
