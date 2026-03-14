<table width="100%" style="margin-bottom:20px;" class="topo">

    <tr>

        <!-- LOGO -->
        <td width="20%" valign="top">
            <img src="logo.png" style="width:100px;">
        </td>


        <!-- DADOS DA EMPRESA -->
        <td width="50%" valign="top">

            <b style="font-size:16px;">{{$conf->nome_completo}}</b><br>
            CNPJ: {{$conf->cnpj}}<br>
            {{$conf->endereco.' - '.$conf->bairro}}<br>
            CEP: {{$conf->cep}}<br>
            Telefone: {{$conf->whatsapp}}

        </td>


        <!-- DADOS DA OS -->
        <td width="30%" valign="top" align="right">

            <table width="100%" class="borda" style="font-size:11px;">

                <tr>
                    <td><b>Ordem Nº</b></td>
                    <td align="right">{{$contrato->id}}</td>
                </tr>

                <tr>
                    <td><b>Data Inicial</b></td>
                    <td align="right">{{\Carbon\Carbon::parse($contrato->data_inicial)->format('d/m/Y')}}</td>
                </tr>
                @if(!is_null($contrato->data_garantia))
                <tr>
                    <td><b>Data Garantia</b></td>
                    <td align="right">{{\Carbon\Carbon::parse($contrato->data_garantia)->format('d/m/Y')}}</td>
                </tr>
                @endif
                <tr>
                    <td><b>Status</b></td>
                    <td align="right">{{$contrato->status->last()->nome}}</td>
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
                    <td style="width: 20%"><b>Nome:</b></td>
                    <td>{{$contrato->cliente->name}}</td>
                </tr>

                <tr>
                    <td><b>Telefone:</b></td>
                    <td>{{$contrato->cliente->contatos->pluck('numero')->join(', ')}}</td>
                </tr>

                <tr>
                    <td><b>Email:</b></td>
                    <td>{{$contrato->cliente->email}}</td>
                </tr>

                {{--<tr>
                    <td><b>Endereço:</b></td>
                    <td>Rua das Flores, 100 - Fortaleza</td>
                </tr>--}}

            </table>

        </td>

        @if($contrato->veiculo != null)
        <td width="50%" valign="top">

            <div class="section">Veículo</div>

            <table class="info">

                <tr>
                    <td style="width: 20%"><b>Placa:</b></td>
                    <td>{{$contrato->veiculo->placa}}</td>
                </tr>

                <tr>
                    <td><b>Marca:</b></td>
                    <td>{{$contrato->veiculo->modelo->montadora->nome}}</td>
                </tr>

                <tr>
                    <td><b>Modelo:</b></td>
                    <td>{{$contrato->veiculo->modelo->nome}}</td>
                </tr>

                <tr>
                    <td><b>Ano:</b></td>
                    <td>{{$contrato->veiculo->ano}}</td>
                </tr>

                {{-- <tr>
                     <td><b>KM:</b></td>
                     <td>85.000</td>
                 </tr>--}}

            </table>

        </td>
        @endif
    </tr>

</table>
