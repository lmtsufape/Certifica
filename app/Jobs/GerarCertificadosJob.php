<?php

namespace App\Jobs;

use App\Mail\CertificadoDisponivel;
use App\Models\Acao;
use App\Models\Certificado;
use App\Models\CertificadoModelo;
use App\Validates\AcaoValidator;
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
     *
     */
    public function handle()
    {
        Log::info("Iniciando Job de geração de certificados para a Ação ID: {$this->acao->id}");

        try {
            $validationMessage = AcaoValidator::validate_acao($this->acao);
            if ($validationMessage) {
                throw new \Exception("Validação da Ação falhou: " . $validationMessage);
            }

            $this->acao->load('atividades.participantes.user');

            $modeloPadrao = CertificadoModelo::where("unidade_administrativa_id", 1)->first();
            if (!$modeloPadrao) {
                throw new \Exception("Nenhum modelo de certificado padrão encontrado para a unidade administrativa 1.");
            }

            $certificadosParaInserir = [];
            $now = now();

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

            DB::transaction(function () use ($certificadosParaInserir) {
                Certificado::insert($certificadosParaInserir);

                $this->acao->status = 'Aprovada';
                $this->acao->save();
            });

            foreach ($this->acao->atividades as $atividade) {
                foreach ($atividade->participantes as $participante) {
                    Mail::to($participante->user->email)->queue(new CertificadoDisponivel([
                        'acao' => $this->acao->titulo,
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
