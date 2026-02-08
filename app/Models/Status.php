<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    public function proximos()
    {
        return $this->belongsToMany('App\Models\Status', 'proximo_status', 'status_id', 'proximo_id');
    }
}
