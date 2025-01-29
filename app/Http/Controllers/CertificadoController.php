<?php

namespace App\Http\Controllers;

use App\Mail\AcaoSubmetida;
use App\Mail\CertificadoDisponivel;
use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Certificado;
use App\Http\Requests\StoreCertificadoRequest;
use App\Http\Requests\UpdateCertificadoRequest;
use App\Models\CertificadoModelo;
use App\Models\Curso;
use App\Models\InfoExternaParticipante;
use App\Models\Natureza;
use App\Models\Participante;
use App\Models\TipoNatureza;
use App\Models\Trabalho;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use App\Validates\AcaoValidator;
use App\Models\User;
use Dompdf\FontMetrics;
use Dompdf\Options;
use function Symfony\Component\Translation\t;


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
        $atividades = Atividade::where('acao_id', $acao->id)->where(function ($query) {
                                $query->where('emissao_parcial', '!=', true)->orWhere('emissao_parcial', null);})->get();


        $message = AcaoValidator::validate_acao($acao);

        if($message){
            return redirect()->back()->with(['alert_mensage' => $message]);

        }

        $certificados_emitidos = collect();

        foreach($atividades as $atividade)
        {
            $participantes = Participante::all()->where("atividade_id", $atividade->id);

            $certificado_modelo = CertificadoModelo::where("unidade_administrativa_id", Auth::user()->unidade_administrativa_id )->where("tipo_certificado", $atividade->descricao)->first();

            if($certificado_modelo == null)
            {
               $certificado_modelo =  CertificadoModelo::where("unidade_administrativa_id", Auth::user()->unidade_administrativa_id)->first();
            }

            if(!$certificado_modelo) return redirect()->back()->with(['alert_mensage' => 'É necessário ter pelo menos um modelo de certificado cadastrado para cada atividade da ação!']);

            foreach($participantes as $participante)
            {
                $certificado = new Certificado();

                if($participante->user->cpf)
                {
                    $certificado->cpf_participante = $participante->user->cpf;
                }
                else
                {
                    $certificado->cpf_participante = $participante->user->passaporte;
                }

                $certificado->codigo_validacao = Str::random(15);
                $certificado->certificado_modelo_id = $certificado_modelo->id;
                $certificado->atividade_id = $atividade->id;

                $certificados_emitidos->push($certificado);
            }
        }

        $certificados_emitidos->each(fn($certificado) => $certificado->save());

        if (Auth::user()->perfil_id == 3 && $acao->usuario_id == Auth::user()->id)
        {
            $acao->status = 'Aprovada';

            $participantes_user = $acao->atividade_participantes_user($acao);

            $acao->update();

            if($participantes_user->isNotEmpty())
            {
                $participantes_user->each(function ($atividade_participantes) use ($acao){

                    $chunkedParticipantes = $atividade_participantes['participantes']->chunk(99); // Divide em grupos de até 99 participantes

                    foreach ($chunkedParticipantes as $chunk)
                    {
                        Mail::bcc($chunk)->queue(new CertificadoDisponivel([
                            'acao' => $acao->titulo
                        ]));
                    }
                });

            }

                return redirect(Route('acao.index'))->with(['mensagem' => 'Certificados Emitidos!']);
        }
        else
        {
            return redirect(Route('gestor.acoes_submetidas'))->with(['mensagem' => 'Ação aprovada!']);
        }
    }


    public function gerar_certificados_parcial($atividade_id)
    {
        $atividade = Atividade::findOrFail($atividade_id);

        if($atividade->emisssao_parcial)
        {
            return redirect(back()->with(['error_mensage' => 'Certificados desta atividade já foram emitidos']));
        }

        $message = AcaoValidator::validate_acao($atividade->acao);

        if($message)
        {
            return redirect()->back()->with(['alert_mensage' => $message]);
        }

        $certificados_emitidos = collect();

        $participantes = Participante::all()->where("atividade_id", $atividade->id);

        $certificado_modelo = CertificadoModelo::where("unidade_administrativa_id", Auth::user()->unidade_administrativa_id )->where("tipo_certificado", $atividade->descricao)->first();

        if($certificado_modelo == null)
        {
            $certificado_modelo =  CertificadoModelo::where("unidade_administrativa_id", Auth::user()->unidade_administrativa_id)->first();
        }

        if(!$certificado_modelo) return redirect()->back()->with(['alert_mensage' => 'É necessário ter pelo menos um modelo de certificado cadastrado para cada atividade da ação!']);

        foreach($participantes as $participante)
        {
            $certificado = new Certificado();

            $certificado->cpf_participante = $participante->user->cpf;
            $certificado->codigo_validacao = Str::random(15);
            $certificado->certificado_modelo_id = $certificado_modelo->id;
            $certificado->atividade_id = $atividade->id;

            $certificados_emitidos->push($certificado);
        }

        $certificados_emitidos->each(fn($certificado) => $certificado->save());

        $atividade->emissao_parcial = true;

        $atividade->update();

        $participantes_user = $atividade->participantes_user($atividade);

        $chunkedParticipantes = $participantes_user->chunk(99);

        foreach ($chunkedParticipantes as $chunk)
        {
            Mail::bcc($chunk)->queue(new CertificadoDisponivel([
                'acao' => $atividade->acao->titulo, 'atividade' => $atividade->descricao
            ]));
        }

        return redirect(route('atividade.index', ['acao_id' => $atividade->acao_id]))->with(['mensagem' => 'Certificados Emitidos!']);
    }

    public function gerar_certificados_requisicao($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);
        $atividades = $acao->atividades()->get();

        $message = AcaoValidator::validate_acao($acao);

        if($message){
            return redirect()->back()->with(['alert_mensage' => $message]);

        }

        $certificados_emitidos = collect();

        foreach($atividades as $atividade)
        {
            $participantes = Participante::all()->where("atividade_id", $atividade->id);

            $certificado_modelo = CertificadoModelo::where("unidade_administrativa_id", 1)->where("tipo_certificado", $atividade->descricao)->first();

            if($certificado_modelo == null)
            {
                $certificado_modelo =  CertificadoModelo::where("unidade_administrativa_id", 1)->first();
            }

            if(!$certificado_modelo) return redirect()->back()->with(['alert_mensage' => 'É necessário ter pelo menos um modelo de certificado cadastrado para cada atividade da ação!']);

            foreach($participantes as $participante)
            {
                $certificado = new Certificado();

                $certificado->cpf_participante = $participante->user->cpf;
                $certificado->codigo_validacao = Str::random(15);
                $certificado->certificado_modelo_id = $certificado_modelo->id;
                $certificado->atividade_id = $atividade->id;

                $certificados_emitidos->push($certificado);
            }
        }

        $certificados_emitidos->each(fn($certificado) => $certificado->save());

            $acao->status = 'Aprovada';

            $acao->update();

            $atividades = $acao->atividades()->get();
            foreach($atividades as $atividade)
            {

                Mail::to($atividade->participantes())->queue(new CertificadoDisponivel([
                    'acao' => $atividade->acao->titulo, 'atividade' => $atividade->descricao,
                ]));
            }
            return redirect(Route('acao.index'))->with(['mensagem' => 'Certificados Emitidos!']);


    }

    public function ver_certificado($participante_id, $marca = null)
    {
        Carbon::setLocale('pt_BR');

        $participante = Participante::findOrFail($participante_id);

        $autorTrabalhoId = $participante->autor_trabalhos_id;
        $coautorTrabalhoId = $participante->coautor_trabalhos_id;

        $trabalho = Trabalho::whereIn('id', [$autorTrabalhoId, $coautorTrabalhoId])->first();

        $info_extra_participante = $participante->info_externa_participante_id;
        if($info_extra_participante){
            $info_extra_participante = InfoExternaParticipante::findOrFail($info_extra_participante);
        }


        $atividade = Atividade::findOrFail($participante->atividade_id);
        $acao = Acao::findOrFail($atividade->acao_id);

        $tipo_natureza = TipoNatureza::findOrFail($acao->tipo_natureza_id);
        $natureza = Natureza::findOrFail($tipo_natureza->natureza_id);

        if($acao->data_personalizada) {
            $data_atual = Carbon::parse($acao->data_personalizada)->isoFormat('LL');
        }
        else {
            $data_atual = Carbon::parse(Carbon::now())->isoFormat('LL');
        }

        if($participante->user->cpf) {
            $certificado = Certificado::where('cpf_participante', $participante->user->cpf)->where('atividade_id', $atividade->id)->first();
        }
        else {
            $certificado = Certificado::where('cpf_participante', $participante->user->passaporte)->where('atividade_id', $atividade->id)->first();
        }


        if(!$certificado) {
            return redirect()->back()->with(['error_mensage' => 'O certificado deste participante foi invalidado, um novo precisa ser emitido!']);
        }

        $modelo = CertificadoModelo::findOrFail($certificado->certificado_modelo_id);


        //$atividade->descricao = Str::lower($atividade->descricao);

        if($atividade->data_inicio == $atividade->data_fim && $modelo->texto_um_dia != null) {
            $modelo->texto = $modelo->texto_um_dia;
        }

        if(mb_strlen($modelo->texto <= 380)) {
            $tamanho_fonte = 38;
        }
        else {
            $tamanho_fonte = 38;
            $excesso_caracteres = mb_strlen($modelo->texto) - 380;

            if ($excesso_caracteres > 0) {
                $reducoes_tamanho = ceil($excesso_caracteres / 65);
                $tamanho_fonte -= $reducoes_tamanho * 2;
            }

            $tamanho_fonte = intval($tamanho_fonte);
        }

        $modelo->texto = CertificadoController::convert_text($modelo, $participante, $acao, $atividade, $natureza, $tipo_natureza, $trabalho,$info_extra_participante);

        $imagem = Storage::url($modelo->fundo);

        $verso = Storage::url($modelo->verso);

        $qrcode = base64_encode(QrCode::generate('http://certifica.ufape.edu.br/validacao/'.$certificado->codigo_validacao));;

        $pdf = Pdf::loadView('certificado.gerar_certificado', compact('modelo', 'participante',
                            'imagem', 'data_atual', 'certificado', 'qrcode', 'verso', 'tamanho_fonte'));

        $nomePDF = 'certificado.pdf';

        $pdf->set_option("dpi", 150);
        $pdf->setPaper('a4', 'landscape');

        if($marca){
            $options = new Options();

            $pdf->render();

            $canvas = $pdf->getCanvas();

            $fontMetrics = new FontMetrics($canvas, $options);

            $w = $canvas->get_width();
            $h = $canvas->get_height();

            $font = $fontMetrics->getFont('times');

            $txtHeight = $fontMetrics->getFontHeight($font, 75);
            $textWidth = $fontMetrics->getTextWidth($marca, $font, 75);

            $canvas->set_opacity(.2, "Multiply");

            $x = (($w-$textWidth)/2);
            $y = (($h-$txtHeight)/2);

            $canvas->page_text($x, $y, $marca, $font, 75);
         }

        return $pdf->stream($nomePDF);
    }

    public function ver_certificado_participante($participante_id)
    {
        $participante = Participante::findOrFail($participante_id);

        if(Auth::user()->id == $participante->user->id){
            return $this->ver_certificado($participante_id);
        }

        return redirect()->back()->withError('Você não pode vizualizar este certificado');
    }

    public function invalidar_certificado($participante_id)
    {
        $participante = Participante::findOrFail($participante_id);

        if($participante->user->cpf)
        {
            $certificado = Certificado::where('cpf_participante', $participante->user->cpf)->where('atividade_id', $participante->atividade->id)->first();
        }
        else
        {
            $certificado = Certificado::where('cpf_participante', $participante->user->passaporte)->where('atividade_id', $participante->atividade->id)->first();
        }

        if(!$certificado)
        {
            return redirect()->back()->with(['error_mensage' => 'O certificado deste participante foi invalidado anteriormente, emita um novo!']);
        }
        else
        {
            $certificado->delete();

            return redirect()->back()->with(['mensagem' => 'Certificado invalidado com sucesso, emita um novo!']);
        }
    }

    public function reemitir_certificado($participante_id)
    {
        $participante = Participante::findOrFail($participante_id);

        $certificado_atual = Certificado::where('cpf_participante', $participante->user->cpf)->where('atividade_id', $participante->atividade->id)->first();

        if($certificado_atual)
        {
            return redirect()->back()->with(['error_mensage' => 'O certificado precisa ser invalidado antes que um novo possa ser emitido!']);
        }
        else
        {
            $certificado_modelo = CertificadoModelo::where("unidade_administrativa_id", Auth::user()->unidade_administrativa_id )->where("tipo_certificado", $participante->atividade->descricao)->first();

            if(!$certificado_modelo)
            {
                $certificado_modelo =  CertificadoModelo::where("unidade_administrativa_id", Auth::user()->unidade_administrativa_id)->first();
            }

            if(!$certificado_modelo) return redirect()->back()->with(['alert_mensage' => 'É necessário ter pelo menos um modelo de certificado cadastrado para cada atividade da ação!']);

            $certificado = new Certificado();

            if($participante->user->cpf)
            {
                $certificado->cpf_participante = $participante->user->cpf;
            }
            else
            {
                $certificado->cpf_participante = $participante->user->passaporte;
            }

            $certificado->codigo_validacao = Str::random(15);
            $certificado->certificado_modelo_id = $certificado_modelo->id;
            $certificado->atividade_id = $participante->atividade->id;

            $certificado->save();

            return redirect()->back()->with(['mensagem' => 'Certificado emitido com sucesso!']);
        }
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
            $user = User::where('cpf', $validacao->cpf_participante)->first();
            $participante = $user->participacoes->where('atividade_id', $validacao->atividade_id)->first();

            $marca = 'Apenas Consulta !';

            return $this->ver_certificado($participante->id, $marca);

        } else
        {
            return redirect()->back()->withErrors('Certificado inválido!');
        }
    }

    public function checar_certificado_qr($codigo_validacao)
    {
        $validacao = Certificado::where('codigo_validacao', $codigo_validacao)->first();

        if($validacao != null)
        {
            return $this->ver_certificado($participante->id, $marca);
        } else
        {
            return view('certificado.validar', ['mensagem' => 'Certificado inválido!']);
        }
    }

    public static function convert_text($modelo, $participante, $acao, $atividade, $natureza, $tipo_natureza, $trabalho, $info_extra_participante){
        $data_inicio = Carbon::parse($atividade->data_inicio)->isoFormat('LL');
        $data_fim = Carbon::parse($atividade->data_fim)->isoFormat('LL');

        $pattern = '/\*[\wÀ-ú\%\.\,\_\-\(\)\#\@\!\'\ "]+\*/i';
        $replace = '<b>$0</b>';

        $modelo->texto = preg_replace($pattern, $replace, $modelo->texto);
        $user = $participante->user;
        $curso = json_decode($user->json_cursos_ids) ;

        if($curso){
            $curso =  (int) reset($curso);
            $curso = Curso::find($curso);

            if($curso){
                $curso = $curso->nome;
            }
        }

        if($atividade->descricao == "apresentação de trabalho")
        {
            if ($trabalho->nomesCoautoresComoTexto() == null) {
                $modelo->texto = str_replace('tendo como coautores %coautores_trabalho%,', '', $modelo->texto);

            }
        }

        if($trabalho){
            $antes = array('%participante%', '%acao%', '%nome_atividade%', '%atividade%', '%data_inicio%', '%data_fim%', '%carga_horaria%', '%natureza%', '%tipo_natureza%', '*',
                '%titulo_trabalho%', '%autores_trabalho%', '%coautores_trabalho%', '%curso%' );
            $depois = array($participante->user->name, $acao->titulo, $participante->titulo, $atividade->descricao, $data_inicio, $data_fim, $participante->carga_horaria,
                $natureza->descricao, $tipo_natureza->descricao, '', $trabalho->titulo, $trabalho->nomesAutoresComoTexto(), $trabalho->nomesCoautoresComoTexto(), $curso);

        } elseif ($info_extra_participante){
            $antes = array('%participante%', '%acao%', '%nome_atividade%', '%atividade%', '%data_inicio%', '%data_fim%', '%carga_horaria%', '%natureza%', '%tipo_natureza%', '*', '%curso%',
                '%orientador%', '%periodo_letivo%', '%disciplina%', '%area%', '%titulo_projeto%', '%local_realizado%');
            $depois = array($participante->user->name, $acao->titulo, $participante->titulo, $atividade->descricao, $data_inicio, $data_fim,
                $participante->carga_horaria, $natureza->descricao, $tipo_natureza->descricao, '', $curso, $info_extra_participante->orientador, $info_extra_participante->periodo_letivo,
                $info_extra_participante->disciplina, $info_extra_participante->area, $info_extra_participante->titulo_projeto, $info_extra_participante->local_realizado);
        }
        else{
            $antes = array('%participante%', '%acao%', '%nome_atividade%', '%atividade%', '%data_inicio%', '%data_fim%', '%carga_horaria%', '%natureza%', '%tipo_natureza%', '*', '%curso%');
            $depois = array($participante->user->name, $acao->titulo, $participante->titulo, $atividade->descricao, $data_inicio, $data_fim,
                $participante->carga_horaria, $natureza->descricao, $tipo_natureza->descricao, '', $curso);

        }



        return str_replace($antes, $depois, $modelo->texto);
    }

    public function previsualizar_certificado($participante_id)
    {
        Carbon::setLocale('pt_BR');

        $participante = Participante::findOrFail($participante_id);

        $autorTrabalhoId = $participante->autor_trabalhos_id;
        $coautorTrabalhoId = $participante->coautor_trabalhos_id;

        $trabalho = Trabalho::whereIn('id', [$autorTrabalhoId, $coautorTrabalhoId])->first();

        $info_extra_participante = $participante->info_externa_participante_id;
        if($info_extra_participante){
            $info_extra_participante = InfoExternaParticipante::findOrFail($info_extra_participante);
        }
        $atividade = Atividade::findOrFail($participante->atividade_id);
        $acao = Acao::findOrFail($atividade->acao_id);

        $tipo_natureza = TipoNatureza::findOrFail($acao->tipo_natureza_id);
        $natureza = Natureza::findOrFail($tipo_natureza->natureza_id);

        if($acao->data_personalizada) {
            $data_atual = Carbon::parse($acao->data_personalizada)->isoFormat('LL');
        }
        else {
            $data_atual = Carbon::parse(Carbon::now())->isoFormat('LL');
        }

        $modelo = CertificadoModelo::where("unidade_administrativa_id", Auth::user()->unidade_administrativa_id )->where("tipo_certificado", $participante->atividade->descricao)->first();

        if(!$modelo) {
            $modelo =  CertificadoModelo::where("unidade_administrativa_id", Auth::user()->unidade_administrativa_id)->first();
        }

        $certificado = new Certificado();

        $certificado->cpf_participante = $participante->user->cpf;
        $certificado->codigo_validacao = Str::random(15);
        $certificado->certificado_modelo_id = $modelo->id;
        $certificado->atividade_id = $participante->atividade->id;

        //$atividade->descricao = Str::lower($atividade->descricao);

        if($atividade->data_inicio == $atividade->data_fim && $modelo->texto_um_dia != null) {
            $modelo->texto = $modelo->texto_um_dia;
        }

        if(mb_strlen($modelo->texto <= 380)) {
            $tamanho_fonte = 38;
        }
        else {
            $tamanho_fonte = 38;
            $excesso_caracteres = mb_strlen($modelo->texto) - 380;

            if ($excesso_caracteres > 0) {
                $reducoes_tamanho = ceil($excesso_caracteres / 65);
                $tamanho_fonte -= $reducoes_tamanho * 2;
            }

            $tamanho_fonte = intval($tamanho_fonte);
        }

        $modelo->texto = CertificadoController::convert_text($modelo, $participante, $acao, $atividade, $natureza, $tipo_natureza, $trabalho, $info_extra_participante);

        $imagem = Storage::url($modelo->fundo);

        $verso = Storage::url($modelo->verso);

        $qrcode = base64_encode(QrCode::generate('http://certifica.ufape.edu.br/validacao/'.'XXYYXXYY'));

        $pdf = Pdf::loadView('certificado.gerar_certificado', compact('modelo', 'participante',
                            'imagem', 'data_atual', 'certificado', 'qrcode', 'verso', 'tamanho_fonte'));

        $nomePDF = 'certificado.pdf';

        $pdf->set_option("dpi", 150);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream($nomePDF);
    }
}
