<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Rafael',
            'nome_completo' => 'Rafael Lima',
            'email' => 'rafael@tecvelautomotiva.com.br',
            'password' => bcrypt('3024'),
            'ativo'     =>  true
        ]);
        User::factory()->create([
            'name' => 'Usuario Tecnico',
            'nome_completo' => 'Usuario Tecnico',
            'email' => 'tecnico@tecnico.com.br',
            'password' => bcrypt('3024'),
            'ativo'     =>  true
        ]);


        DB::table('grupos')->insert([
            ['nome'=>'Admin','admin'=>1,'tecnico'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'Técnico','admin'=>0,'tecnico'=>1,'created_at'=>now(),'updated_at'=>now()]
        ]
        );

        DB::table('permissoes')->insert([
            ['nome'=>'usuario-lista','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'usuario-criar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'usuario-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'usuario-deletar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'usuario-visualizar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'grupo-lista','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'grupo-criar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'grupo-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'grupo-deletar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'grupo-visualizar','created_at'=>now(),'updated_at'=>now()],
        ]);

        DB::table('user_grupo')->insert([
           ['user_id'=>1,'grupo_id'=>1],
           ['user_id'=>2,'grupo_id'=>2],
        ]);

        DB::table('grupo_permissao')->insert([
           ['grupo_id'=>1,'permissao_id'=>1],
           ['grupo_id'=>1,'permissao_id'=>2],
           ['grupo_id'=>1,'permissao_id'=>3],
           ['grupo_id'=>1,'permissao_id'=>4],
           ['grupo_id'=>1,'permissao_id'=>5],
           ['grupo_id'=>1,'permissao_id'=>6],
           ['grupo_id'=>1,'permissao_id'=>7],
           ['grupo_id'=>1,'permissao_id'=>8],
            ['grupo_id'=>1,'permissao_id'=>9],
            ['grupo_id'=>1,'permissao_id'=>10],

            ['grupo_id'=>2,'permissao_id'=>1],
            ['grupo_id'=>2,'permissao_id'=>6],


        ]);

        DB::table('contatos')->insert([
           ['numero'=>'85987067785'],
           ['numero'=>'85986607785'],
           ['numero'=>'85988056135'],
        ]);

        DB::table('user_contato')->insert([
           ['user_id'=>1,'contato_id'=>1],
           ['user_id'=>1,'contato_id'=>2],
           ['user_id'=>2,'contato_id'=>3],
        ]);


    }
}
