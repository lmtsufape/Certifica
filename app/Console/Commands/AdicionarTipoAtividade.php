<?php

namespace App\Console\Commands;

use App\Models\TipoAtividade;
use Illuminate\Console\Command;

class AdicionarTipoAtividade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adicionar:tipoAtividade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inseri os dados que estão definidos
    na variável descrições da função create de AtividadeController
    na tabela de tipo_atividades';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $names = ['Avaliador(a)', 'Bolsista', 'Colaborador(a)', 'Comissão Organizadora', 'Conferencista', 'Coordenador(a)', 'Formador(a)', 'Ministrante', 'Orientador(a)',
        'Palestrante', 'Voluntário(a)', 'Participante', 'Vice-coordenador(a)', 'Ouvinte', 'Apresentação de Trabalho'];

        foreach($names as $name){
            if(!TipoAtividade::where('name', $name)->first()){
                TipoAtividade::create(['name' => $name]);
            }
        }

        return Command::SUCCESS;
    }
}
