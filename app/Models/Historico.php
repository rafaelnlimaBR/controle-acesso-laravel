<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public function registros()
    {
        return $this->hasMany(Registro::class,'historico_id');
    }

    public function gravar(Request $r)
    {

        $this->descricao        = $r->get('descricao');
        $this->data             = Carbon::createFromFormat('d/m/Y',$r->get('data'));

        $this->save();
    }
}
