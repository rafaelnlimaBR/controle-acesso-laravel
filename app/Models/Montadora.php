<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Montadora extends Model
{
    protected $table = 'montadoras';

    public function modelo()
    {
        return $this->hasmany(Modelo::class);
    }
}
