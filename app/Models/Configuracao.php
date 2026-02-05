<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    protected $table = 'configuracoes';



    public static function getConfig()
    {
        return self::find(1);
    }

    public function teste()
    {

    }
}
