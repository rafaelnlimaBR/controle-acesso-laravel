<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \SimpleSoftwareIO\QrCode\Facades\QrCode;
class TaxaEntrada extends Model
{
    protected $table = 'taxas_entradas';

    public function tipo()
    {
        return $this->belongsTo(TipoEntrada::class,'tipo_id');
    }

    public function entrada()
    {
        return $this->hasMany(Entrada::class,'taxa_id');
    }
    public function dadoBancario()
    {
        return $this->belongsTo(DadoBancario::class, 'dado_bancario_id');
    }



    function calcularCRC16($payload) {
        $result = 0xFFFF;
        $polynomial = 0x1021;
        for ($i = 0; $i < strlen($payload); $i++) {
            $result ^= (ord($payload[$i]) << 8);
            for ($j = 0; $j < 8; $j++) {
                if ($result & 0x8000) {
                    $result = ($result << 1) ^ $polynomial;
                } else {
                    $result <<= 1;
                }
            }
        }
        return str_pad(strtoupper(dechex($result & 0xFFFF)), 4, '0', STR_PAD_LEFT);
    }

    public function gerarQRCode($valor)
    {
        $taxa   =   $this;

        $payload = "000201";
        $payload .= "010211";
        $payload .= "26" . strlen("0014br.gov.bcb.pix"."01".strlen($taxa->dadobancario->chave_pix).$taxa->dadobancario->chave_pix) . "0014br.gov.bcb.pix" . "01" . strlen($taxa->dadobancario->chave_pix) . $taxa->dadobancario->chave_pix;
        $payload .= "52040000";
        $payload .= "5303986";
        $payload .= "54" . sprintf("%02d", strlen($valor)) . $valor; // Valor editável
        $payload .= "5802BR";
        $payload .= "59" . str_pad(strlen($taxa->dadobancario->nome_titular), 2, 0, STR_PAD_LEFT) . $taxa->dadobancario->nome_titular; // Nome editável
        $payload .= "6009" . "Fortaleza"; // Cidade editável
        $payload .= "62070503***"; // ID/Descrição

        $payload .= "6304";
        $crc16  =   $taxa->calcularCRC16($payload);
        $payload.= $crc16;



        $qrcode     =   QrCode::size(400)->generate($payload);

        return $qrcode;
    }
}
