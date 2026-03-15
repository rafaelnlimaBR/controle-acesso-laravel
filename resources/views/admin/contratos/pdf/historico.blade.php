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
        .info td{
            border:none;
            padding:3px;
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
<h2 style="text-align: center; border-bottom: 1px solid black">HISTÓRICO</h2>
@include('admin.contratos.pdf.includes.cabecalho')

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
