<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Certificado;
use App\Http\Requests\StoreCertificadoRequest;
use App\Http\Requests\UpdateCertificadoRequest;
use App\Models\CertificadoModelo;
use App\Models\Natureza;
use App\Models\Participante;
use App\Models\TipoNatureza;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use App\Validates\AcaoValidator;


class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gerar_certificados($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);
        $atividades = $acao->atividades()->get();
        
        $message = AcaoValidator::validate_acao($acao);
        
        if($message){
            return redirect()->back()->with(['alert_mensage' => $message]);

        }

        foreach($atividades as $atividade)
        {
            $participantes = Participante::all()->where("atividade_id", $atividade->id);

            $certificado_modelo = CertificadoModelo::where("unidade_administrativa_id", Auth::user()->unidade_administrativa_id )->where("tipo_certificado", $atividade->descricao)->first();

            if($certificado_modelo == null)
            {
               $certificado_modelo =  CertificadoModelo::where("unidade_administrativa_id", Auth::user()->unidade_administrativa_id)->first();
            }

            foreach($participantes as $participante)
            {
                $certificado = new Certificado();

                $certificado->cpf_participante = $participante->user->cpf;
                $certificado->codigo_validacao = Str::random(15);
                $certificado->certificado_modelo_id = $certificado_modelo->id;
                $certificado->atividade_id = $atividade->id;

                $certificado->save();
            }
        }

        if (Auth::user()->perfil_id == 3)
        {
            $acao->status = 'Aprovada';

            $acao->update();

            return redirect(Route('acao.index'))->with(['mensagem' => 'Ação submetida !']);;
        }
        else
        {
            return redirect(Route('gestor.acoes_submetidas'))->with(['mensagem' => 'Ação submetida !']);;
        }

    }
    public function ver_certificado($participante_id)
    {
        Carbon::setLocale('pt_BR');

        $participante = Participante::findOrFail($participante_id);
        $atividade = Atividade::findOrFail($participante->atividade_id);
        $acao = Acao::findOrFail($atividade->acao_id);

        $tipo_natureza = TipoNatureza::findOrFail($acao->tipo_natureza_id);
        $natureza = Natureza::findOrFail($tipo_natureza->natureza_id);


        $data_inicio = Carbon::parse($atividade->data_inicio)->isoFormat('LL');
        $data_fim = Carbon::parse($atividade->data_fim)->isoFormat('LL');

        $data_atual = Carbon::parse(Carbon::now())->isoFormat('LL');

        $certificado = Certificado::where('cpf_participante', $participante->user->cpf)->where('atividade_id', $atividade->id)->first();

        $modelo = CertificadoModelo::findOrFail($certificado->certificado_modelo_id);

        $atividade->descricao = Str::lower($atividade->descricao);

        $antes = array('%participante%', '%acao%', '%nome_atividade%', '%atividade%', '%data_inicio%', '%data_fim%', '%carga_horaria%', '%natureza%', '%tipo_natureza%');
        $depois = array($participante->user->name, $acao->titulo, $participante->titulo, $atividade->descricao, $data_inicio, $data_fim,
                        $participante->carga_horaria, $natureza->descricao, $tipo_natureza->descricao);

        $modelo->texto = str_replace($antes, $depois, $modelo->texto);

        $imagem = Storage::url($modelo->fundo);

        $verso = Storage::url($modelo->verso);

        $qrcode = base64_encode(QrCode::generate('http://certifica.ufape.edu.br/validacao/'.$certificado->codigo_validacao));;

        $pdf = Pdf::loadView('certificado.gerar_certificado', compact('modelo', 'participante',
                            'imagem', 'data_atual', 'certificado', 'qrcode', 'verso'));

        $nomePDF = 'certificado.pdf';

        return $pdf->set_option("dpi", 200)->setPaper('a4', 'landscape')->stream($nomePDF);
    }

    public function ver_certificado_participante($participante_id){
        $participante = Participante::findOrFail($participante_id);

        if(Auth::user()->id == $participante->user->id){
            return $this->ver_certificado($participante_id);
        }

        return redirect()->back()->withError('Você não pode vizualizar este certificado');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCertificadoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificadoRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function show(Certificado $certificado)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCertificadoRequest  $request
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificadoRequest $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificado  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function validar_certificado()
    {
        return view('certificado.validar_certificado');
    }

    public function checar_certificado(Request $request)
    {
        $validacao = Certificado::where('codigo_validacao', $request->codigo_validacao)->first();

        if($validacao != null)
        {
            return view('certificado.validar', ['mensagem' => 'Certificado válido!']);
        } else
        {
            return view('certificado.validar', ['mensagem' => 'Certificado inválido!']);
        }
    }

    public function checar_certificado_qr($codigo_validacao)
    {
        $validacao = Certificado::where('codigo_validacao', $codigo_validacao)->first();

        if($validacao != null)
        {
            return view('certificado.validar', ['mensagem' => 'Certificado válido!']);
        } else
        {
            return view('certificado.validar', ['mensagem' => 'Certificado inválido!']);
        }
    }
}
