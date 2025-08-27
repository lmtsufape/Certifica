<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCertificadoApiRequest;
use App\Services\CertificadoApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class RequisicaoController extends Controller
{
    /**
     * Construtor para injetar as dependências (Service).
     */
    public function __construct(private CertificadoApiService $certificadoApiService)
    {
    }

    /**
     * Lida com a requisição para criar certificados.
     *
     * @param StoreCertificadoApiRequest $request
     * @return JsonResponse
     */
    public function criarCertificado(): JsonResponse
    {
        dd('teste');
        try {
            // 1. A validação já foi feita pela StoreCertificadoApiRequest.
            // 2. A lógica de negócio é delegada para o Service.
            $acoesCriadas = $this->certificadoApiService->criarCertificados(
                $request->validated()
            );

            // 3. O controlador apenas retorna a resposta de sucesso.
            return response()->json([
                'message' => 'Ações e certificados enfileirados para processamento com sucesso.',
                'acoes_criadas' => count($acoesCriadas)
            ], 201);

        } catch (Throwable $e) {
            // Captura qualquer exceção que o Service possa lançar.
            Log::error('Erro no endpoint de criar certificado: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return response()->json(['message' => 'Ocorreu um erro interno ao processar a solicitação.'], 500);
        }
    }
}
