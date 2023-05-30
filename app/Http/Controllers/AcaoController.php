<?php

namespace App\Http\Controllers;

use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Natureza;
use App\Models\SubmeterAcao;
use App\Models\TipoNatureza;
use App\Models\UnidadeAdministrativa;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAcaoRequest;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Validates\AcaoValidator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\CertificadoModelo;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Certificado;
use Illuminate\Support\Str;
use Carbon\Carbon;
use ZipArchive;
use File;


class AcaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acaos = Acao::all()->where('usuario_id', Auth::user()->id)->sortBy('id');

        return view('acao.acao_index', ['acaos' => $acaos]);
    }

    public function list(){
        return view('acao.list');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $naturezas = Natureza::all()->sortBy('id');

        $naturezas_ensino = TipoNatureza::all()->where('natureza_id', 1);
        $naturezas_extensao = TipoNatureza::all()->where('natureza_id', 2);
        $naturezas_pesquisa = TipoNatureza::all()->where('natureza_id', 3);

        return view('acao.acao_create', compact('naturezas', 'naturezas_ensino', 'naturezas_extensao',
                                                    'naturezas_pesquisa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAcaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            AcaoValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('acao.create'))
                ->withErrors($exception->validator)->withInput();
        }

        if($request->natureza_id == 1)
        {
            $request->tipo_natureza_id = $request->ensino;
        } else if($request->natureza_id == 2)
        {
            $request->tipo_natureza_id = $request->extensao;
        } else if($request->natureza_id == 3)
        {
            $request->tipo_natureza_id = $request->pesquisa;
        }

        $acao = new Acao();

        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->tipo_natureza_id = $request->tipo_natureza_id;
        $acao->usuario_id = $request->usuario_id;

        $natureza = Natureza::find($request->natureza_id);

        $acao->unidade_administrativa_id = $natureza->unidade_administrativa_id;

        $acao->anexo = $request->file('anexo')->store('anexos');

        $acao->save();

        return redirect(Route('acao.index'))->with(['mensagem' => 'Ação cadastrada com sucesso']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acao  $acao
     * @return \Illuminate\Http\Response
     */
    public function show($acao_id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acao  $acao
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $naturezas_ensino = TipoNatureza::all()->where('natureza_id', 1);
        $naturezas_extensao = TipoNatureza::all()->where('natureza_id', 2);
        $naturezas_pesquisa = TipoNatureza::all()->where('natureza_id', 3);

        $acao = Acao::findOrFail($id);
        $natureza = Natureza::findOrFail($acao->tipo_natureza->natureza_id);
        $tipo_natureza = TipoNatureza::findOrFail($acao->tipo_natureza_id);
        $naturezas = Natureza::all()->sortBy('id');


        return view('acao.acao_edit',compact('acao','naturezas', 'natureza',
        'naturezas_ensino','naturezas_extensao', 'naturezas_pesquisa','tipo_natureza'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAcaoRequest  $request
     * @param  \App\Models\Acao  $acao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            AcaoValidator::validate($request->all());
        } catch (ValidationException $exception) {

            return redirect(route('acao.edit', ['acao_id' => $request->id]))->withErrors($exception->validator)->withInput();
        }

        if($request->natureza_id == 1)
        {
            $request->tipo_natureza_id = $request->ensino;
        } else if($request->natureza_id == 2)
        {
            $request->tipo_natureza_id = $request->extensao;
        } else if($request->natureza_id == 3)
        {
            $request->tipo_natureza_id = $request->pesquisa;
        }



        $acao = Acao::findOrFail($request->id);

        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->tipo_natureza_id = $request->tipo_natureza_id;
        $acao->usuario_id = $request->usuario_id;

        $natureza = Natureza::find($request->natureza_id);
        $acao->unidade_administrativa_id = $natureza->unidade_administrativa_id;

        $acao->update();

        return redirect(Route('acao.index'))->with(['mensagem' => 'Ação editada com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acao  $acao
     * @return \Illuminate\Http\Response
     */
    public function delete($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);

        if($acao->atividades()->first()){
            return redirect(route('acao.index'))->with(['error_mensage' => 'A ação não pode ser excluída.
                                                                Existe uma ou mais atividades vinculadas a ela.']);
        }

        $acao->delete();

        return redirect(Route('acao.index'))->with(['mensagem' => 'Ação excluída com sucesso']);
    }

    public function submeter_acao($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);

        $acao->status = 'Em análise';

        $acao->update();

        return redirect(Route('acao.index'));
    }

    public function acoes_submetidas()
    {
        $acaos = Acao::all()->where('status', '!=', null)->where
                ('unidade_administrativa_id', Auth::user()->unidade_administrativa_id)->sortBy('id');

        return view('gestor_institucional.acoes_submetidas', ['acaos' => $acaos]);
    }

    public function analisar_acao($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);
        $atividades = Atividade::all()->where('acao_id', $acao_id)->sortBy('id');

        return view('gestor_institucional.analisar_acao', ['acao' => $acao, 'atividades' => $atividades]);
    }

    public function acao_update(Request $request)
    {
        $acao = Acao::findOrFail($request->id);

        if($request->action == 'reprovar')
        {
           $status = 'Reprovada';
        } else
        {
            $status = 'Aprovada';
        }

        $acao->status = $status;

        $acao->update();

        if($status == 'Aprovada')
        {
            return redirect(Route('gestor.gerar_certificados', ['acao_id' => $acao->id]));
        } else
        {
            return redirect(Route('gestor.acoes_submetidas'));
        }

    }

    public function download_anexo($id){
        $acao = Acao::findOrFail($id);
        return Storage::download($acao->anexo);
    }

    public function download_certificados($id){
        $acao = Acao::find($id);
        $certificados = [];
        $zip = new ZipArchive();
        $zipname = sys_get_temp_dir()."/certificados.zip";


        if($zip->open($zipname, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE) == true){
            foreach ($acao->atividades as $atividade) {
                foreach( $atividade->participantes as $participante){
                    $nomePDF = 'certificado - '.$participante->user->name.'.pdf';
                    array_push($certificados, $nomePDF);

                    $pdf = $this->montar_certificado($participante, $atividade, $acao, $nomePDF);
                    
                    $zip->addFile($nomePDF);
                }
            }
        }

        // Fecha arquivo Zip aberto
        $zip->close();

        //exclui os pdf gerados 
        foreach ($certificados as $certificado){
            File::delete($certificado);
        }


        
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=certificados.zip');
        header("Pragma: no-cache"); 
        header("Expires: 0");
        header('Cache-Control: must-revalidate');
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
    }


    private function montar_certificado($participante, $atividade, $acao, $nomePDF){
        Carbon::setLocale('pt_BR');
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

        $qrcode = base64_encode(QrCode::generate('http://certifica.ufape.edu.br/validacao/'.$certificado->codigo_validacao));


        $pdf = Pdf::loadView('certificado.gerar_certificado', compact('modelo', 'participante',
                            'imagem', 'data_atual', 'certificado', 'qrcode', 'verso'));
        
        
        $pdf->set_option("dpi", 200)->setPaper('a4', 'landscape');
        $pdf->render();
        $output = $pdf->output();


        return file_put_contents($nomePDF, $output);       
        
    }

}
