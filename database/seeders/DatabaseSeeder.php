<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Info;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MontadorasSeeder::class,
            ModelosSeeder::class,

        ]);

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

            ['nome'=>'categoria-visualizar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'categoria-criar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'categoria-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'categoria-deletar','created_at'=>now(),'updated_at'=>now()],

            ['nome'=>'postagem-visualizar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'postagem-criar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'postagem-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'postagem-deletar','created_at'=>now(),'updated_at'=>now()],

            ['nome'=>'tipopagamento-visualizar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'tipopagamento-criar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'tipopagamento-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'tipopagamento-deletar','created_at'=>now(),'updated_at'=>now()],

            ['nome'=>'banner-visualizar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'banner-criar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'banner-editar','created_at'=>now(),'updated_at'=>now()],
            ['nome'=>'banner-deletar','created_at'=>now(),'updated_at'=>now()],
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
            'orcamento_online_id'      =>  7,
            'andamento_id'     =>  3,
            'concluido_id'      =>  4,
            'retorno_id'        =>  5,
            'cancelado_id'      =>  6,
            'nao_autorizado_id'  =>  2,
            'descricao_cliente_id'  =>  4,
        ]);


        \Laravel\Prompts\info('Inserindo veiculos');
        DB::table('veiculos')->insert([
            ['placa'=>'HUI3024','ano'=>'2012','cor'=>'Preto','modelo_id'=>1],
            ['placa'=>'PNC0A80','ano'=>'2012','cor'=>'Preto','modelo_id'=>2],
            ['placa'=>'OCA2A12','ano'=>'2012','cor'=>'Preto','modelo_id'=>3],
            ['placa'=>'OIB1212','ano'=>'2012','cor'=>'Preto','modelo_id'=>4],
        ]);

        \Laravel\Prompts\info('Inserindo Status');
        DB::table('status')->insert([
            ['nome'=>'Orçamento','cobrar'=>false,'renovar_garantia'=>false,'cor_fundo'=>'E8EB50','cor_letra'=>'3D3D3D'],
            ['nome'=>'Não Autorizado','cobrar'=>false,'renovar_garantia'=>false,'cor_fundo'=>'EB5050','cor_letra'=>'FCFCFC'],
            ['nome'=>'Andamento','cobrar'=>true,'renovar_garantia'=>false,'cor_fundo'=>'50EB9B','cor_letra'=>'FCFCFC'],
            ['nome'=>'Concluido','cobrar'=>true,'renovar_garantia'=>true,'cor_fundo'=>'465AE8','cor_letra'=>'FCFCFC'],
            ['nome'=>'Retorno','cobrar'=>true,'renovar_garantia'=>false,'cor_fundo'=>'465AE8','cor_letra'=>'FCFCFC'],
            ['nome'=>'Cancelado','cobrar'=>false,'renovar_garantia'=>false,'cor_fundo'=>'E88446','cor_letra'=>'FCFCFC'],
            ['nome'=>'Orçamento Online','cobrar'=>false,'renovar_garantia'=>false,'cor_fundo'=>'E8EB50','cor_letra'=>'3D3D3D'],
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

            ['atual_status_id'=>'7','proximo_status_id'=>'2'],
            ['atual_status_id'=>'7','proximo_status_id'=>'3'],  //ORçamento
            ['atual_status_id'=>'7','proximo_status_id'=>'6'],
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
            ['nome'=>'Defeito','compartilhavel'=>true,'icon'=>'bi bi-exclamation-triangle-fill'],
            ['nome'=>'Descricao do cliente','compartilhavel'=>true,'icon'=>'bi bi-exclamation-triangle-fill'],
        ]);

        \Laravel\Prompts\info('Inserindo Registros');
        DB::table('registros')->insert([
            ['historico_id'=>1,'descricao'=>'Defeito na placa, curto por conta de agua','tipo_id'=>3,'data'=>Carbon::now(),'autor_id'=>1],
        ]);

        \Laravel\Prompts\info('Inserindo Imagens');
        DB::table('registros_imagens')->insert([
            ['nome'=>'user-01.png','registro_id'=>1],
        ]);

        \Laravel\Prompts\info('Inserindo Serviços');
        DB::table('servicos')->insert([
            ['nome'=>'Reparo do painel','valor'=>'100'],
            ['nome'=>'Reparo do modulo','valor'=>'100']
        ]);

        DB::table('historico_servico')->insert([
            ['servico_id'=>1,'historico_id'=>1,'valor_liquido'=>'100','valor_bruto'=>'100','desconto'=>0],
            ['servico_id'=>2,'historico_id'=>1,'valor_liquido'=>'550','valor_bruto'=>'100','desconto'=>0],
        ]);

        DB::table('pecas_avulsas')->insert([
            ['nome'=>'Painel de instrumentos gol','valor_liquido'=>'900','valor_bruto'=>'900','desconto'=>0,'cobrar'=>0,'devolver'=>0, 'historico_id'=>1,'marca'=>'VDO' ,'qnt'=>1 ],
            ['nome'=>'Modeulo de injeção','valor_liquido'=>'850','valor_bruto'=>'1500','desconto'=>20,'cobrar'=>0,'devolver'=>0, 'historico_id'=>1,'marca'=>'VDO'  ,'qnt'=>1 ],
        ]);

        DB::table('dados_bancarios')->insert([
            ['nome_banco'=>'inter','nome_titular'=>'Tecvel','numero_conta'=>'6592152-6','chave_pix'=>'28727291000133']
        ]);

        DB::table('tipos_entradas')->insert([
            ['nome'=>'Pix','pix'=>1],
            ['nome'=>'Maquina Ton','pix'=>0],
            ['nome'=>'Cartão de Débito','pix'=>0]
        ]);


        DB::table('taxas_entradas')->insert([
            ['nome'=>'CNPJ','dado_bancario_id'=>1,'taxa'=>0,'tipo_id'=>1],


        ]);
        DB::table('entradas')->insert([
            ['descricao'=>'Pagamento da OS 001','valor_original'=>150,'valor_cliente'=>150,'valor_loja'=>150,'repassar_taxa'=>false,'data'=>Carbon::now(),'autor_id'=>1,'taxa_id'=>1],
        ]);
        DB::table('historico_entrada')->insert([
            ['entrada_id'=>1,'historico_id'=>1],
        ]);

        DB::table('categorias')->insert([
            ['nome'=>'Reparo em paineis de instrumentos','ativo'=>1,'nome_link'=>'reparo-painel-de-instrumentos'],
            ['nome'=>'Reparo em modulos de injeção','ativo'=>1,'nome_link'=>'reparo-injecao-eletronica'],
        ]);
        DB::table('postagens')->insert([
            ['titulo'=>'teste 01','meta_descricao'=>'meda descricao','titulo_link'=>'teste_01','ativo'=>1,'conteudo'=>'teste 01','autor_id'=>1,'visualizacoes'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        DB::table('categoria_postagem')->insert([
            ['postagem_id'=>1,'categoria_id'=>1]
        ]);
        DB::table('comentarios')->insert([
            ['conteudo'=>'comentario 001','user_id'=>1,'ativo'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['conteudo'=>'resposta 001','user_id'=>1,'ativo'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        DB::table('comentario_postagem')->insert([
            ['postagem_id'=>1,'comentario_id'=>1],
        ]);
        DB::table('comentario_resposta')->insert([
            ['comentario_id'=>1,'resposta_id'=>2]
        ]);
        DB::table('imagens_posts')->insert([
            ['nome'=>'imagem 001','imagem'=>'123.jpg','descricao'=>'descricao 001','ativo'=>1,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
        ]);
        DB::table('postagens_imagens')->insert([
            ['postagem_id'=>1,'imagem_id'=>1]
        ]);

    }
}
