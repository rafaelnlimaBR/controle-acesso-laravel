<!DOCTYPE html>
<html lang="pt-br">
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

        .bloco{
            border:1px solid #000;
            margin-bottom:15px;
        }

        .titulo-bloco{
            background:#eee;
            font-weight:bold;
            padding:6px;
        }

        .conteudo{
            padding:8px;
        }

        .img-veiculo{
            width:120px;
            margin-right:10px;
        }

    </style>

</head>
<body>


<!-- CABEÇALHO -->

<table style="margin-bottom:20px;">

    <tr>

        <td width="20%">
            <img src="logo.png" style="width:90px;">
        </td>

        <td width="50%">

            <b style="font-size:16px;">TECVEL ELETRÔNICA AUTOMOTIVA</b><br>
            CNPJ: 28.727.291/0001-33<br>
            Rua Pinto Madeira, 750 - Centro<br>
            Fortaleza - CE

        </td>

        <td width="30%" align="right">

            <table class="borda" style="font-size:11px;">

                <tr>
                    <td><b>OS Nº</b></td>
                    <td align="right">000123</td>
                </tr>

                <tr>
                    <td><b>Placa</b></td>
                    <td align="right">ABC1D23</td>
                </tr>

                <tr>
                    <td><b>Cliente</b></td>
                    <td align="right">José</td>
                </tr>

            </table>

        </td>

    </tr>

</table>



<div class="section">Histórico da Ordem de Serviço</div>



<!-- ENTRADA -->

<div class="bloco">

    <div class="titulo-bloco">
        Entrada do Veículo - 13/03/2026 08:15
    </div>

    <div class="conteudo">

        <b>Observações:</b>

        <p>
            Cliente relatou que o marcador de velocidade não está funcionando corretamente.
        </p>


        <b>Imagens da Entrada:</b>

        <br><br>

        <img src="img1.jpg" class="img-veiculo">
        <img src="img2.jpg" class="img-veiculo">
        <img src="img3.jpg" class="img-veiculo">

    </div>

</div>



<!-- AUTORIZAÇÃO -->

<div class="bloco">

    <div class="titulo-bloco">
        Serviço Autorizado - 13/03/2026 11:00
    </div>

    <div class="conteudo">

        <b>Serviços Autorizados</b>

        <table class="borda">

            <tr>
                <th>Serviço</th>
                <th width="120">Valor</th>
            </tr>

            <tr>
                <td>Aferição de painel</td>
                <td>R$ 150,00</td>
            </tr>

            <tr>
                <td>Reparo marcador velocidade</td>
                <td>R$ 200,00</td>
            </tr>

        </table>

        <br>

        <b>Peças Autorizadas</b>

        <table class="borda">

            <tr>
                <th>Peça</th>
                <th width="80">Qtd</th>
                <th width="120">Valor</th>
            </tr>

            <tr>
                <td>Sensor de velocidade</td>
                <td>1</td>
                <td>R$ 120,00</td>
            </tr>

        </table>

    </div>

</div>



<!-- CONCLUSÃO -->

<div class="bloco">

    <div class="titulo-bloco">
        Serviço Concluído - 13/03/2026 16:10
    </div>

    <div class="conteudo">

        <b>Serviços Realizados</b>

        <table class="borda">

            <tr>
                <th>Descrição</th>
                <th width="120">Valor</th>
            </tr>

            <tr>
                <td>Reparo no circuito do marcador de velocidade</td>
                <td>R$ 200,00</td>
            </tr>

        </table>

        <br>

        <b>Observações Finais</b>

        <p>
            Painel testado e funcionando normalmente após reparo.
        </p>


        <b>Imagens após serviço</b>

        <br><br>

        <img src="img4.jpg" class="img-veiculo">
        <img src="img5.jpg" class="img-veiculo">

    </div>

</div>



</body>
</html>
