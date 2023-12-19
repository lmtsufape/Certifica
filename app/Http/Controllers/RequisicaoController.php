<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\User;
use http\Encoding\Stream\Enbrotli;
use Illuminate\Http\Request;

class RequisicaoController extends Controller
{
    //
    public function criarCertificado(Request $request)
    {
        // Obtenha os dados do JSON enviado
        $dadosJSON = json_decode($request->getContent(), true);

        $usuario = User::where([
            'perfil_id' => 3,
            'unidade_administrativa_id' => 1,
        ])->first();

        foreach ($dadosJSON as $acaoJSON) {
            $acaoController = new AcaoController();

            // Criar uma nova ação usando o método store do AcaoController
            $acao = $acaoController->requisicao(new Request([
                'titulo' => $acaoJSON['acao']['titulo'],
                'data_inicio' => $acaoJSON['acao']['data_inicio'],
                'data_fim' => $acaoJSON['acao']['data_fim'],
                'tipo_natureza' => $acaoJSON['tipo_natureza'],
                'natureza_id' => 1,
                'usuario_id' => $usuario->id
                // Outros campos necessários para criar uma ação
            ]));



            // Criar atividades para a ação
            foreach ($acaoJSON['atividades'] as $atividadeJSON) {
                // Criar uma nova atividade associada à ação usando o método store do AtividadeController (assumindo que você tenha um controlador para atividades)
                 $atividadeController = new AtividadeController();
                 $atividade = $atividadeController->requisicao(new Request([
                     'data_inicio' => $atividadeJSON['data_inicio'],
                     'descricao' => $atividadeJSON['descricao'],
                     'data_fim' => $atividadeJSON['data_fim'],
                     'acao_id' => $acao->original['acao']['id']
                     // Outros campos necessários para criar uma atividade
                 ]));


                 foreach ($atividadeJSON['participantes'] as $participanteJSON){
                     $participanteController = new ParticipanteController();

                     if (isset($participanteJSON['curso'])) {
                         $cursos = Curso::where('nome', $participanteJSON['curso'])->first();

                         if ($cursos) {
                             $jsonCursosIds = json_encode([strval($cursos->id)]);
                         } else {
                             // Define um valor padrão (ID 8) se nenhum curso for encontrado
                             $jsonCursosIds = json_encode(["8"]);
                         }
                     } else {
                         // Se não houver valor para 'curso', define $jsonCursosIds como null
                         $jsonCursosIds = null;
                     }


                     $participante = $participanteController->requisicao( new Request([
                         'atividade_id' => $atividade->original['atividade']['id'],
                         'cpf' => $participanteJSON['cpf'],
                         'email' => $participanteJSON['email'],
                         'nome' => $participanteJSON['nome'],
                         'carga_horaria' => $participanteJSON['carga_horaria'],
                         'instituicao' => $participanteJSON['instituicao'],
                         'instituicao_id' => $participanteJSON['instituicao_id'],
                         'passaporte' => $participanteJSON['passaporte'],
                         'json_cursos_ids' => $jsonCursosIds


                     ]));
                 }

                // Lógica para criar atividades associadas à ação
            }

            $certificadoController = new CertificadoController();
            $certificadoController->gerar_certificados_requisicao($acao->original['acao']['id']);

            // Lógica para associar atividades à ação (relacionamento entre ação e atividade)
        }

        return response()->json(['mensagem' => 'Ações criadas com sucesso a partir do JSON']);
    }


}
