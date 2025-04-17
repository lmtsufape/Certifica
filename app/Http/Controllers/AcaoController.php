<?php

namespace App\Http\Controllers;

use App\Mail\LembreteCertificadoDisponivel;
use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Natureza;
use App\Models\SubmeterAcao;
use App\Models\TipoNatureza;
use App\Models\UnidadeAdministrativa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAcaoRequest;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Validates\AcaoValidator;
use App\Validates\CertificadoModeloValidator;
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
use Illuminate\Support\Facades\Mail;
use App\Mail\AnalisarAcao;
use App\Mail\CertificadoDisponivel;
use App\Mail\AcaoSubmetida;
use App\Mail\AcaoSubmetidaCoordenador;
use App\Jobs\ZipCertificados;
use App\Models\TipoAtividade;

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
        $naturezas = Natureza::orderBy('descricao')->get();

        return view('acao.acao_index', compact('acaos', 'naturezas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->perfil_id == 3) {
            $natureza = Natureza::where('unidade_administrativa_id', Auth::user()->unidade_administrativa_id)->first();
            $tipo_naturezas = TipoNatureza::where('natureza_id', $natureza->id)
                ->orderBy('descricao')
                ->get();

            return view('acao.acao_create', compact('natureza', 'tipo_naturezas'));
        } else {
            $naturezas = Natureza::all()->sortBy('descricao');

            return view('acao.acao_create', compact('naturezas'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreAcaoRequest $request
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

        $acao = new Acao();

        $natureza = Natureza::find($request->natureza_id);

        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->tipo_natureza_id = $request->tipo_natureza_id;
        $acao->usuario_id = $request->usuario_id;
        $acao->unidade_administrativa_id = $natureza->unidade_administrativa_id;
        $acao->data_personalizada = $request->data_personalizada;

        if (Auth::user()->perfil_id == 3) {
            $acao->anexo = null;
        } else {
            $nomeAnexo = $request->file('anexo')->getClientOriginalName();
            $acao->anexo = $request->file('anexo')->storeAs('anexos/' . $acao->id, $nomeAnexo);
        }


        $acao->save();

        return redirect(Route('acao.index'))->with(['mensagem' => 'Ação cadastrada com sucesso']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreAcaoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function requisicao(Request $request)
    {

        try {
            AcaoValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('acao.create'))
                ->withErrors($exception->validator)->withInput();
        }

        $acao = new Acao();

        $natureza = Natureza::find($request->natureza_id);
        $tipo_natureza = TipoNatureza::where('descricao', $request->tipo_natureza)->first();
        if (!$tipo_natureza) {
            $tipo_natureza = new TipoNatureza();
            $tipo_natureza->descricao = $request->tipo_natureza;
            $tipo_natureza->natureza_id = $request->natureza_id;
            $tipo_natureza->save();
        }

        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->tipo_natureza_id = $tipo_natureza->id;
        $acao->usuario_id = $request->usuario_id;
        $acao->unidade_administrativa_id = $natureza->unidade_administrativa_id;


        $acao->anexo = null;

        // Salvar a ação no banco de dados
        $acao->save();

        // Retornar o objeto da ação com o atributo de id
        return response(['acao' => $acao]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Acao $acao
     * @return \Illuminate\Http\Response
     */
    public function show($acao_id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Acao $acao
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acao = Acao::findOrFail($id);
        $natureza = Natureza::findOrFail($acao->tipo_natureza->natureza_id);
        $tipo_natureza = TipoNatureza::findOrFail($acao->tipo_natureza_id);

        // Ordenando tipo_naturezas pela descrição
        $tipo_naturezas = TipoNatureza::where('natureza_id', $natureza->id)
            ->orderBy('descricao')
            ->get();

        // Ordenando naturezas pela descrição
        $naturezas = Natureza::all()->sortBy('descricao');

        $nomeAnexo = $acao->anexo ? explode("/", $acao->anexo)[2] : "";

        return view('acao.acao_edit', compact('acao', 'natureza', 'tipo_natureza', 'naturezas', 'tipo_naturezas', 'nomeAnexo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAcaoRequest $request
     * @param \App\Models\Acao $acao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            AcaoValidator::validate($request->all());
        } catch (ValidationException $exception) {

            return redirect(route('acao.edit', ['acao_id' => $request->id]))->withErrors($exception->validator)->withInput();
        }

        $acao = Acao::findOrFail($request->id);

        $natureza = Natureza::find($request->natureza_id);

        $acao->titulo = $request->titulo;
        $acao->data_inicio = $request->data_inicio;
        $acao->data_fim = $request->data_fim;
        $acao->tipo_natureza_id = $request->tipo_natureza_id;
        $acao->unidade_administrativa_id = $natureza->unidade_administrativa_id;
        $acao->data_personalizada = $request->data_personalizada;

        if ($request->file('anexo')) {
            $nomeAnexo = $request->file('anexo')->getClientOriginalName();
            $acao->anexo = $request->file('anexo')->storeAs('anexos/' . $acao->id, $nomeAnexo);
        }

        $acao->update();

        if (Auth::user()->id != $acao->usuario_id) {
            return redirect(Route('gestor.acoes_submetidas'))->with(['mensagem' => 'Ação editada com sucesso']);
        } else {
            return redirect(Route('acao.index'))->with(['mensagem' => 'Ação editada com sucesso']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Acao $acao
     * @return \Illuminate\Http\Response
     */
    public function delete($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);

        if ($acao->atividades()->first()) {
            return redirect(route('acao.index'))->with([
                'error_mensage' => 'A ação não pode ser excluída.
                                                                Existe uma ou mais atividades vinculadas a ela.'
            ]);
        }

        $acao->delete();

        return redirect(Route('acao.index'))->with(['mensagem' => 'Ação excluída com sucesso']);
    }

    public function submeter_acao($acao_id)
    {
        Carbon::setLocale('pt_BR');

        $acao = Acao::findOrFail($acao_id);

        $message = AcaoValidator::validate_acao($acao);

        if ($message) {
            return redirect()->back()->with(['alert_mensage' => $message]);
        }

        $acao->status = 'Em análise';
        $acao->data_submissao = Carbon::now();
        $acao->update();

        $user = $acao->unidadeAdministrativa->users->where('perfil_id', 3)->first();

        //enviar email
        if ($user) {
            Mail::to($user)->send(new AcaoSubmetida([
                'acao' => $acao->titulo,
                'acao_id' => $acao->id,
            ]));

            Mail::to(Auth::user()->email)->queue(new AcaoSubmetidaCoordenador([
                'acao' => $acao->titulo,
                'acao_id' => $acao->id,
            ]));
        }

        return redirect(Route('acao.index'))->with(['mensagem' => 'Ação submetida !']);
    }

    public function acoes_submetidas()
    {
        return view('gestor_institucional.acoes_submetidas');
    }

    public function list_acoes_submetidas()
    {
        $acaos = Acao::whereNotNull('status')->where('unidade_administrativa_id', Auth::user()->unidade_administrativa_id)->orderBy('created_at', 'desc')->get();

        foreach ($acaos as $acao) {
            if ($acao->data_submissao) {
                $acao->data_submissao = Carbon::parse($acao->data_submissao)->format('d/m/Y H:i');
            }
        }

        return view('gestor_institucional.list_acoes_submetidas', ['acaos' => $acaos]);
    }

    public function analisar_acao($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);
        $atividades = Atividade::all()->where('acao_id', $acao_id)->sortBy('id');
        $descricoes = [
            'Avaliador(a)',
            'Bolsista',
            'Colaborador(a)',
            'Comissão Organizadora',
            'Conferencista',
            'Coordenador(a)',
            'Formador(a)',
            'Ministrante',
            'Orientador(a)',
            'Palestrante',
            'Voluntário(a)',
            'Participante',
            'Vice-coordenador(a)',
            'Ouvinte',
            'Apresentação de Trabalho'
        ];

        $tipoAtividade = TipoAtividade::where('unidade_administrativa_id', $acao->unidade_administrativa_id)->get();
        $tipoAtividadeName = $tipoAtividade->pluck('name')->toArray();
        $tipos_ordenados = array_merge($tipoAtividadeName, $descricoes);
        sort($tipos_ordenados);

        return view('gestor_institucional.analisar_acao', ['acao' => $acao, 'atividades' => $atividades, 'tipos_ordenados' => $tipos_ordenados]);
    }

    public function acao_update(Request $request)
    {
        $acao = Acao::findOrFail($request->id);

        $message = $request->action == "aprovar" ? CertificadoModeloValidator::validate_acao($acao) : null;

        if ($message) {
            return redirect()->back()->with(['alert_mensage' => $message]);
        }

        if ($request->action == 'reprovar') {
            $status = 'Reprovada';
        } elseif ($request->action == 'devolver') {
            $status = 'Devolvida';
        } else {
            $status = 'Aprovada';
        }

        $acao->status = $status;
        $acao->observacao_gestor = $request->observacao_gestor;

        $acao->update();


        //enviar email para o coordenador
        Mail::to($acao->user->email, $acao->user->name)->queue(new AnalisarAcao([
            'acao' => $acao->titulo,
            'status' => $acao->status,
            'id' => $acao->id,
        ]));

        if ($status == 'Aprovada') {
            //enviar email para os integrantes
            $participantes_user = $acao->participantes();

            $chunkedParticipantes = $participantes_user->chunk(99);

            foreach ($chunkedParticipantes as $chunk) {
                Mail::bcc($chunk)->queue(new CertificadoDisponivel([
                    'acao' => $acao->titulo,
                ]));
            }

            return redirect(Route('gestor.gerar_certificados', ['acao_id' => $acao->id]));
        } else {
            return redirect(Route('gestor.acoes_submetidas'));
        }
    }

    public function download_anexo($id)
    {
        $acao = Acao::findOrFail($id);
        return Storage::download($acao->anexo);
    }

    public function download_certificados($id)
    {
        $acao = Acao::find($id);

        $caminho = "app" . DIRECTORY_SEPARATOR . "certificados_" . str_replace(' ', '_', $acao->titulo);

        $filePath = storage_path($caminho . DIRECTORY_SEPARATOR . 'certificados.zip');

        if (file_exists($filePath)) {
            return response()->download($filePath, 'certificados.zip');
        } else {
            ZipCertificados::dispatch($acao);
        }

        return redirect()->back()->with(['mensagem' => 'Quando todos os certificados estiverem disponíveis para download, você será notificado por e-mail!']);
    }

    public function deletar_certificados($acao_id)
    {
        $acao = Acao::find($acao_id);

        $caminho = "certificados_" . str_replace(' ', '_', $acao->titulo);

        Storage::deleteDirectory($caminho);

        return redirect()->back()->with(['mensagem' => 'Quando todos os certificados estiverem disponívcis para download, você será notificado por e-mail!']);
    }

    public function get_tipo_natureza($natureza_id)
    {
        $tipo_naturezas = TipoNatureza::where('natureza_id', $natureza_id)->get();

        return response()->json($tipo_naturezas);
    }


    public function filtro()
    {
        $acoes = Auth::user()->acoes()->get();


        if (request('buscar_acao')) {
            $acoes = Acao::search_acao_by_name($acoes, request('buscar_acao'));
        }

        if (request('status')) {
            $acoes = Acao::search_acao_by_status($acoes, request('status'));
        }


        //        if (request('data')) {
        //            $acoes = Acao::search_acao_by_data($acoes, request('data'));
        //        }



        if (request('natureza')) {
            $acoes = Acao::search_acao_by_natureza($acoes, request('natureza'));
        }


        return view('acao.acao_list', compact('acoes'));
    }

    public function lembrete_certificado_disponivel($acao_id)
    {
        $acao = Acao::findOrFail($acao_id);

        $participantes_user = $acao->participantes();

        $chunkedParticipantes = $participantes_user->chunk(99);

        foreach ($chunkedParticipantes as $chunk) {
            Mail::bcc($chunk)->queue(new LembreteCertificadoDisponivel([
                'acao' => $acao->titulo,
            ]));
        }

        return redirect()->back()->with(['mensagem' => 'Lembrete enviado aos integrantes!']);
    }

    public function importarAcao(Request $request)
    {
        $request->validate([
            'acao' => 'required|file|mimes:json|max:2048',
        ]);

        // Obtém o conteúdo do arquivo
        $file = $request->file('acao');
        $jsonContent = file_get_contents($file->getRealPath());

        // Decodifica o JSON
        $data = json_decode($jsonContent, true);

        // Verifica se o JSON é válido
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->with('error', 'Arquivo JSON inválido.');
        }

        dd($data);

        return back()->with('success', 'Arquivo lido com sucesso!');
    }
}
