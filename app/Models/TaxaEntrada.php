<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxaEntrada extends Model
{
    protected $table = 'taxas_entradas';


    public function dado_bancario()
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
}
