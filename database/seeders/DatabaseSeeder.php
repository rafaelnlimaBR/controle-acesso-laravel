<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Info;
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
        \Laravel\Prompts\info('Inserindo usuarios');
        User::factory()->create([
            'name' => 'Rafael',

            'email' => 'rafael@tecvelautomotiva.com.br',
            'password' => bcrypt('3024'),
            'ativo'     =>  true,
            'imagem'    =>  'user-01.png',
            'deletavel'  =>  true,
            'editavel'  =>  true,
            'visivel'  =>  true,
        ]);
        User::factory()->create([
            'name' => 'Usuario Tecnico',

            'email' => 'tecnico@tecnico.com.br',
            'password' => bcrypt('3024'),
            'ativo'     =>  true,
            'imagem'    =>  'user-01.png',
            'deletavel'  =>  true,
            'editavel'  =>  true,
            'visivel'  =>  true,
        ]);
        User::factory()->create([
            'name' => 'CT',

            'email' => 'cliente@cliente.com.br',
            'password' => bcrypt('3024'),
            'ativo'     =>  true,
            'imagem'    =>  'user-01.png',
            'deletavel'  =>  true,
            'editavel'  =>  true,
            'visivel'  =>  true,
        ]);
        User::factory()->create([
            'name' => 'Administrador',

            'email' => 'admin@admin.com.br',
            'password' => bcrypt('30242789Rafa@'),
            'ativo'     =>  true,
            'imagem'    =>  'user-01.png',
            'deletavel'  =>  false,
            'editavel'  =>  false,
            'visivel'  =>  false,
        ]);
        \Laravel\Prompts\info('Inserindo grupos');
        DB::table('grupos')->insert([
            ['nome'=>'ADMIN','visivel'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'TéCNICO','visivel'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'CLIENTE','visivel'=>true,'created_at'=>now(),'updated_at'=>now()]
        ]
        );
        \Laravel\Prompts\info('Inserindo permissoes');
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
            ['nome'=>'veiculo-lista','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'veiculo-criar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'veiculo-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'veiculo-deletar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'veiculo-visualizar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'montadora-lista','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'montadora-criar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'montadora-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'montadora-deletar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'montadora-visualizar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'modelo-lista','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'modelo-criar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'modelo-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'modelo-deletar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'modelo-visualizar','created_at'=>now(),'updated_at'=>now()],


            ['nome'=>'contrato-lista','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'contrato-criar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'contrato-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'contrato-deletar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'contrato-visualizar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'contrato-registro-visualizar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'contrato-registro-criar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'contrato-registro-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'contrato-registro-deletar','created_at'=>now(),'updated_at'=>now()],


            ['nome'=>'configuracao-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'configuracao-visualizar','created_at'=>now(),'updated_at'=>now()],
        ]);

        DB::table('user_grupo')->insert([
           ['user_id'=>1,'grupo_id'=>1],
           ['user_id'=>2,'grupo_id'=>2],
           ['user_id'=>3,'grupo_id'=>3],
           ['user_id'=>4,'grupo_id'=>1],
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




        ]);
        \Laravel\Prompts\info('Inserindo contatos');
        DB::table('contatos')->insert([
           ['numero'=>'85987067785'],
           ['numero'=>'85986607785'],
           ['numero'=>'85988056135'],
        ]);

        DB::table('user_contato')->insert([
           ['user_id'=>1,'contato_id'=>1],
           ['user_id'=>1,'contato_id'=>2],
           ['user_id'=>2,'contato_id'=>3],
           ['user_id'=>4,'contato_id'=>3],
        ]);


        \Laravel\Prompts\info('Inserindo configuracoes');
        DB::table('configuracoes')->insert([
            'nome_simples'      =>'NOME EMPRESA',
            'nome_completo'     =>'EMPRESA COMPLETO',
            'email'             => 'empresa@empresa.com.br',
            'whatsapp'          => '+55 11 987654321',
            'endereco'          => 'endereco endereco',
            'bairro'            => 'bairro bairro',
            'cidade'            => 'cidade cidade',
            'estado'            => 'estado estado',
            'cep'               => 'cep cep',
            'cnpj'              => '28727291000133',
            'instagran'         =>  'tecvel',
            'grupo_admin_id'    =>  1,
            'grupo_tecnico_id'  =>  2,
            'grupo_cliente_id'  =>  3,
            'orcamento_id'      =>  1,
            'andamento_id'     =>  2,
            'concluido_id'      =>  3,
            'retorno_id'        =>  4,
            'cancelado_id'      =>  5,
            'nao_autorizado_id'  =>  6,
        ]);

        \Laravel\Prompts\info('Inserindo montadoras');
        DB::table('montadoras')->insert([
            ['nome'=>'Ford'],
            ['nome'=>'VW'],
            ['nome'=>'GM'],
            ['nome'=>'Fiat'],
            ['nome'=>'Renault'],
            ['nome'=>'Peugeot'],
            ['nome'=>'BYD'],
        ]);

        \Laravel\Prompts\info('Inserindo modelos de veiculos');
        DB::table('modelos')->insert([
            ['nome'=>'Ka','montadora_id'=>1],
            ['nome'=>'Fiesta','montadora_id'=>1],
            ['nome'=>'Gol Bola','montadora_id'=>2],
            ['nome'=>'Voyage G5','montadora_id'=>2],
            ['nome'=>'Celta','montadora_id'=>3],
            ['nome'=>'Classic','montadora_id'=>3],
        ]);
        \Laravel\Prompts\info('Inserindo veiculos');
        DB::table('veiculos')->insert([
            ['placa'=>'HUI3024','ano'=>'2012','cor'=>'Preto','modelo_id'=>1],
            ['placa'=>'PNC0A80','ano'=>'2012','cor'=>'Preto','modelo_id'=>3],
            ['placa'=>'OCA2A12','ano'=>'2012','cor'=>'Preto','modelo_id'=>5],
            ['placa'=>'OIB1212','ano'=>'2012','cor'=>'Preto','modelo_id'=>6],
        ]);

        \Laravel\Prompts\info('Inserindo Status');
        DB::table('status')->insert([
            ['nome'=>'Orçamento','cobrar'=>false,'renovar_garantia'=>false,'cor_fundo'=>'E8EB50','cor_letra'=>'3D3D3D'],
            ['nome'=>'Não Autorizado','cobrar'=>false,'renovar_garantia'=>false,'cor_fundo'=>'EB5050','cor_letra'=>'FCFCFC'],
            ['nome'=>'Andamento','cobrar'=>true,'renovar_garantia'=>false,'cor_fundo'=>'50EB9B','cor_letra'=>'FCFCFC'],
            ['nome'=>'Concluido','cobrar'=>true,'renovar_garantia'=>true,'cor_fundo'=>'465AE8','cor_letra'=>'FCFCFC'],
            ['nome'=>'Retorno','cobrar'=>true,'renovar_garantia'=>false,'cor_fundo'=>'465AE8','cor_letra'=>'FCFCFC'],
            ['nome'=>'Cancelado','cobrar'=>false,'renovar_garantia'=>false,'cor_fundo'=>'E88446','cor_letra'=>'FCFCFC'],
        ]);
        DB::table('status_proximos')->insert([
            ['atual_status_id'=>'1','proximo_status_id'=>'2'],
            ['atual_status_id'=>'1','proximo_status_id'=>'3'],  //ORçamento
            ['atual_status_id'=>'1','proximo_status_id'=>'6'],

            ['atual_status_id'=>'3','proximo_status_id'=>'4'],  //Andamento
            ['atual_status_id'=>'3','proximo_status_id'=>'6'],

            ['atual_status_id'=>'4','proximo_status_id'=>'5'],  //Concluido
            ['atual_status_id'=>'4','proximo_status_id'=>'6'],

            ['atual_status_id'=>'5','proximo_status_id'=>'3'],  //Retorno
            ['atual_status_id'=>'5','proximo_status_id'=>'6'],
        ]);


        \Laravel\Prompts\info('Inserindo Contratos');
        DB::table('contratos')->insert([
             ['descricao_cliente'=>'teste teste','observacao'=>'teste','solucao'=>'tete','data_inicio'=>Carbon::now(),'data_garantia'=>Carbon::now(),'criador_id'=>1,'tecnico_id'=>1,'cliente_id'=>3,'veiculo_id'=>1,'desconto_peca'=>5,'desconto_servico'=>5],
        ]);

        DB::table('historicos')->insert([
            ['contrato_id'=>1,'status_id'=>1,'autor_id'=>1,'descricao'=>'tesate','data'=>Carbon::now()],
        ]);

        \Laravel\Prompts\info('Inserindo Tipor de Registros');
        DB::table('registros_tipos')->insert([
            ['nome'=>'Recebimento','compartilhavel'=>true,'icon'=>'bi bi-file-earmark-text'],
            ['nome'=>'Testes em bancada','compartilhavel'=>true,'icon'=>'bi bi-joystick'],
            ['nome'=>'Defeito','compartilhavel'=>true,'icon'=>'bi bi-exclamation-triangle-fill']
        ]);

        \Laravel\Prompts\info('Inserindo Registros');
        DB::table('registros')->insert([
            ['historico_id'=>1,'descricao'=>'Defeito na placa, curto por conta de agua','tipo_id'=>3,'data'=>Carbon::now(),'autor_id'=>1],
        ]);

        \Laravel\Prompts\info('Inserindo Imagens');
        DB::table('registros_imagens')->insert([
            ['nome'=>'user-01.png','registro_id'=>1],
        ]);



    }
}
