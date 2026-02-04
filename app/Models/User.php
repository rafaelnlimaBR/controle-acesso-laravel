<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function validacao($dados, $id = null)
    {
        $regras =   [
            'nome'          =>  'required|min:3|max:100',
            'email'         =>  'required|email|unique:App\Models\User,email'.(is_null($id) ? '' : ",$id"),
            'nome_completo' =>  'required|min:3|max:100',
            'grupos'        =>  'required|array|min:1',
        ];
        if(is_null($id)){
            $regras['senha'] =  'required|min:3|max:8';
            $regras['contato'] =  'required';
        }

        return Validator::make($dados, $regras);


    }

    public function scopePesquisarPorNome($query, $nome)
    {
        return $query->where('name','like','%'.$nome.'%');
    }
    public function scopePesquisarPorTelefone($query, $telefone)
    {
        if(is_null($telefone)){
            return $query;
        }
        return $query->whereHas('contatos', function ($query) use ($telefone) {
            $query->where('numero', 'like','%'.$telefone.'%');
        });
    }

    public function isAdmin()
    {
        if($this->grupos()->where('admin',1)->count() >= 1){
            return true;
        }
        return false;
    }

    public function habilidades()
    {
        return $this->grupos->map->permissoes->flatten()->pluck('nome');
    }

    public function contatos()
    {
        return $this->belongsToMany('App\Models\Contato','user_contato','user_id','contato_id')->withPivot('id','observacao','whatsapp');
    }

    public function grupos()
    {
        return $this->belongsToMany('App\Models\Grupo','user_grupo','user_id','grupo_id');
    }


    public function gravar(Request $request)
    {
        $this->name             = strtoupper($request->get('nome'));
        $this->nome_completo    =   strtoupper($request->get('nome_completo'));
        $this->email             =   strtolower($request->get('email'));
        $this->password          =   Hash::make($request->get('senha'));
        $this->ativo            =   $request->get('ativo')=="1"?1:0;

        $this->save();

        $this->grupos()->sync($request->get('grupos'));
    }

    public function adicionarContato(String $numero,bool $whatsapp, $observacao)
    {

        $contato        =   new Contato();
        $contato        =   $contato->gravar($numero);

        $this->contatos()->save($contato,['observacao'=>$observacao,'whatsapp'=>$whatsapp]);
    }

    public function removerContato(String $contato)
    {
        $this->contatos()->detach($contato);
    }

}
