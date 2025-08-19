<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCertificadoRequest;
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
     * @param StoreCertificadoRequest $request
     * @return JsonResponse
     */
    public function criarCertificado(StoreCertificadoRequest $request): JsonResponse
    {
        try {
            $acoesCriadas = $this->certificadoApiService->criarCertificados(
                $request->validated()
            );

            return response()->json([
                'message' => 'Ações e certificados enfileirados para processamento com sucesso.',
                'acoes_criadas' => count($acoesCriadas)
            ], 201);

        } catch (Throwable $e) {
            Log::error('Erro no endpoint de criar certificado: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return response()->json(['message' => 'Ocorreu um erro interno ao processar a solicitação.'], 500);
        }
    }
}
