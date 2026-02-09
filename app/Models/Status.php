<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    public function proximos()
    {
        return $this->belongsToMany('App\Models\Status', 'status_proximos', 'atual_status_id', 'proximo_status_id');
    }
}
