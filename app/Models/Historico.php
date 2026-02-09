<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $table = 'historicos';


    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function autor()
    {
        return $this->belongsTo(User::class,'autor_id');
    }
}
