<?php

namespace App\Jobs;

use App\Mail\CertificadoDisponivel; // Certifique-se de que este Mailable existe
use App\Models\Acao;
use App\Models\Certificado;
use App\Models\CertificadoModelo;
use App\Validators\AcaoValidator; // Supondo que seu validador esteja aqui
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class GerarCertificadosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * A instância da Ação para a qual os certificados serão gerados.
     */
    protected Acao $acao;

    /**
     * Create a new job instance.
     */
    public function __construct(Acao $acao)
    {
        $this->acao = $acao;
    }

    /**
     * Execute the job.
     * O método handle agora contém a lógica de geração de certificados refatorada.
     */
    public function handle()
    {
        Log::info("Iniciando Job de geração de certificados para a Ação ID: {$this->acao->id}");

        try {
            // 1. Validação inicial da Ação.
            // Se a validação falhar, o job falhará e poderá ser tentado novamente.
            $validationMessage = AcaoValidator::validate_acao($this->acao);
            if ($validationMessage) {
                // Lança uma exceção para fazer o job falhar.
                throw new \Exception("Validação da Ação falhou: " . $validationMessage);
            }

            // 2. Eager Loading: Carrega a ação com todas as suas atividades, participantes e os usuários
            // dos participantes em poucas consultas, resolvendo o problema N+1.
            $this->acao->load('atividades.participantes.user');

            // 3. Busca do Modelo de Certificado Otimizada
            $modeloPadrao = CertificadoModelo::where("unidade_administrativa_id", 1)->first();
            if (!$modeloPadrao) {
                throw new \Exception("Nenhum modelo de certificado padrão encontrado para a unidade administrativa 1.");
            }

            $certificadosParaInserir = [];
            $now = now(); // Usar o mesmo timestamp para todos os registros

            foreach ($this->acao->atividades as $atividade) {
                // Tenta encontrar um modelo específico, se não, usa o padrão.
                $modelo = CertificadoModelo::where("unidade_administrativa_id", 1)
                                ->where("tipo_certificado", $atividade->descricao)
                                ->first() ?? $modeloPadrao;

                foreach ($atividade->participantes as $participante) {
                    // Prepara um array com os dados para o bulk insert.
                    $certificadosParaInserir[] = [
                        'cpf_participante' => $participante->user->cpf,
                        'codigo_validacao' => Str::random(15),
                        'certificado_modelo_id' => $modelo->id,
                        'atividade_id' => $atividade->id,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }

            if (empty($certificadosParaInserir)) {
                Log::warning("Nenhum participante encontrado para a Ação ID: {$this->acao->id}. Nenhum certificado foi gerado.");
                return;
            }

            // 4. Lógica de Banco de Dados Atômica (Transaction)
            DB::transaction(function () use ($certificadosParaInserir) {
                // 5. Bulk Insert: Insere todos os certificados com uma única query.
                Certificado::insert($certificadosParaInserir);

                // 6. Atualiza o status da ação.
                $this->acao->status = 'Aprovada';
                $this->acao->save();
            });

            // 7. Envio de E-mails Otimizado (após a transação ser bem-sucedida)
            foreach ($this->acao->atividades as $atividade) {
                foreach ($atividade->participantes as $participante) {
                    Mail::to($participante->user->email)->queue(new CertificadoDisponivel([
                        'acao' => $this->acao->titulo,
                        'atividade' => $atividade->descricao,
                    ]));
                }
            }

            Log::info("Job de geração de certificados para a Ação ID: {$this->acao->id} concluído com sucesso.");

        } catch (Throwable $e) {
            Log::error("Falha no Job de geração de certificados para a Ação ID: {$this->acao->id}. Erro: {$e->getMessage()}");
            // Lança a exceção novamente para que a fila possa lidar com a falha (retry/failed_jobs).
            $this->fail($e);
        }
    }
}
