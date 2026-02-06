<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

    }


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

    public function scopeVisiveis($query)
    {
        return $query->where('visivel',1);
    }

    public function isAdmin()
    {
        if( $this->grupos()->find(Configuracao::getConfig()->grupo_admin_id) != null){
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


        if(is_null($this)){
            if (!file_exists(public_path('/layout/imagens/users/'))){
                mkdir(public_path('/layout/imagens/users/'), 0777, true);
            }
            $filename="";
            $image       =   $request->file('imagem');
            $filename = Str::random(16).'.'.$image->getClientOriginalExtension();

            $resize  =  ImageManager::gd()->read($image->getRealPath());
            $resize->save(public_path('/layout/imagens/users/').$filename);

            $this->imagem   =   $filename;
        }


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

    public function deletar()
    {
        if(File::exists(public_path('/layout/imagens/users/').$this->imagem)){
            if($this->imagem =! "user-01.png"){
                File::delete(public_path('/layout/imagens/users/').$this->imagem);
            }
        }
        $this->delete();
    }

    public function mudarSenha(String $senha)
    {

        $this->password         =   Hash::make($senha);
        $this->save();
    }
}
