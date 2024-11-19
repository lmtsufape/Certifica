<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportParticipantesRequest;
use App\Models\Acao;
use App\Models\Atividade;
use App\Models\Curso;
use App\Models\InfoExternaParticipante;
use App\Models\Instituicao;
use App\Models\Participante;
use App\Models\Trabalho;
use App\Models\User;
use App\Models\Natureza;
use Illuminate\Http\Request;
use App\Http\Requests\StoreParticipanteRequest;
use App\Http\Requests\UpdateParticipanteRequest;
use App\Validates\ParticipanteValidator;
use App\Validates\DefaultValidator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Utils\Mask;
use Illuminate\Support\Facades\Mail;
use App\Mail\UsuarioNaoCadastrado;
use App\Rules\Cpf;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($atividade_id, $solicitacao = null)
    {
        if ($solicitacao !== null) {
            $solicitacao = filter_var($solicitacao, FILTER_VALIDATE_BOOLEAN);
            }
        $participantes = Participante::all()->where('atividade_id', $atividade_id)->sortBy('id');
        $atividade = Atividade::findOrFail($atividade_id);
        $acao = Acao::findOrFail($atividade->acao_id);

        $cont = 0;

        return view('participante.participante_index',compact('participantes','atividade','acao','cont','solicitacao'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autor_index($trabalho_id, $solicitacao = null)
    {
        if ($solicitacao !== null) {
            $solicitacao = filter_var($solicitacao, FILTER_VALIDATE_BOOLEAN);
        }
        $autores = Participante::all()->where('autor_trabalhos_id', $trabalho_id)->sortBy('id');
        $coautores = Participante::all()->where('coautor_trabalhos_id', $trabalho_id)->sortBy('id');
        $trabalho = Trabalho::findOrFail($trabalho_id);
        $atividade = Atividade::findOrFail($trabalho->atividade_id);
        $acao = Acao::findOrFail($atividade->acao_id);

        $cont = 0;

        return view('trabalho.trabalho_autores_index',compact('autores','coautores','trabalho','atividade','acao','cont','solicitacao'));

    }

    public function autor_create($trabalho_id, Request $request)
    {

        $option = $request->cpf_pass;
        $cpf = $request->cpf;
        $passaporte = $request->passaporte;
        $tipo = $request->tipo;


        $user = $cpf ? User::where('cpf', $cpf)->first() : User::where('passaporte', $passaporte)->first();

        $trabalho = Trabalho::findOrFail($trabalho_id);
        $atividade = Atividade::findOrFail($trabalho->atividade_id);

        $instituicaos = Instituicao::all();


        if ($user) {
            return view('trabalho.trabalho_autores_create', ['atividade' => $atividade, 'user' => $user, 'tipo' => $tipo, 'trabalho' => $trabalho, 'instituicaos' => $instituicaos, 'option' => $option ]);
        }


        return view('trabalho.trabalho_autores_create', ['atividade' => $atividade, 'cpf' => $cpf, 'passaporte' => $passaporte, 'tipo' => $tipo, 'trabalho' => $trabalho, 'instituicaos' => $instituicaos,'option' => $option]);
    }

    public function autor_store(Request $request, $tipo)
    {
        $attributes = $request->all();


        if(!$attributes['instituicao']){
            $instituicao = Instituicao::find($attributes['instituicao_id']);

            $attributes['instituicao'] = $instituicao ? $instituicao->nome : "Outras";
        }

        try {
            ParticipanteValidator::validate($attributes);
        } catch (ValidationException $exception) {
            return redirect(route('autor.create', ['trabalho_id' => $attributes['trabalho_id'], 'cpf' => $attributes['cpf'], 'passaporte' => $attributes['passaporte'], ]))
                ->withErrors($exception->validator)->withInput();
        }

        $atividade = Atividade::find($attributes['atividade_id']);

        $trabalho = Trabalho::findOrFail($attributes['trabalho_id']);


        if($attributes['cpf']){
            if($trabalho->autores->where('user.cpf', $attributes['cpf'] )->first() or $trabalho->coautores->where('user.cpf', $attributes['cpf'] )->first()){
                return redirect(Route('trabalho.index', ['atividade_id' => $attributes['atividade_id']]))
                    ->with(['error_mensage' => 'Não é possível adicionar o mesmo participante mais de uma vez no mesmo trabalho!']);
            }
        }

        if($attributes['passaporte']){
            if($atividade->participantes->where('user.passaporte', $attributes['passaporte'])->first()){
                return redirect(Route('participante.index', ['atividade_id' => $attributes['atividade_id']]))
                    ->with(['error_mensage' => 'Não é possível adicionar o mesmo participante mais de uma vez na mesma atividade!']);
            }
        }



        try{
            $user = $this->createUser($attributes);

        } catch (ValidationException $exception) {
            return redirect()->back()->withErrors($exception->validator)->withInput();
        }

        if ($attributes['tipo'] === 'Autor'){
            $attributes['autor_trabalhos_id'] = $attributes['trabalho_id'];
        }else{
            $attributes['coautor_trabalhos_id'] = $attributes['trabalho_id'];
        }
        $attributes['user_id'] = $user->id;
        Participante::create($attributes);

        return redirect(Route('autor.index', ['trabalho_id' => $attributes['trabalho_id']]))
            ->with(['mensagem' => $tipo . ' cadastrado com sucesso']);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($atividade_id, Request $request)
    {
        $option = $request->cpf_pass;
        $cpf = $request->cpf;
        $passaporte = $request->passaporte;

        $user = $cpf ? User::where('cpf', $cpf)->first() : User::where('passaporte', $passaporte)->first();

        $atividade = Atividade::findOrFail($atividade_id);
        $instituicaos = Instituicao::all();

        if ($user) {
            return view('participante.participante_create', ['atividade' => $atividade, 'user' => $user, 'instituicaos' => $instituicaos, 'option' => $option ]);
        }

        return view('participante.participante_create', ['atividade' => $atividade, 'cpf' => $cpf, 'passaporte' => $passaporte, 'instituicaos' => $instituicaos,'option' => $option]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreParticipanteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all();

        if(!$attributes['instituicao']){
            $instituicao = Instituicao::find($attributes['instituicao_id']);

            $attributes['instituicao'] = $instituicao ? $instituicao->nome : "Outras";
        }

        try {
            ParticipanteValidator::validate($attributes);
        } catch (ValidationException $exception) {
            return redirect(route('participante.create', ['atividade_id' => $attributes['atividade_id'], 'cpf' => $attributes['cpf'], 'passaporte' => $attributes['passaporte']]))
                ->withErrors($exception->validator)->withInput();
        }

        $atividade = Atividade::find($attributes['atividade_id']);


        if($attributes['cpf']){
            if($atividade->participantes->where('user.cpf', $attributes['cpf'] )->first()){
                return redirect(Route('participante.index', ['atividade_id' => $attributes['atividade_id']]))
                                ->with(['error_mensage' => 'Não é possível adicionar o mesmo participante mais de uma vez na mesma atividade!']);
            }
        }

        if($attributes['passaporte']){
            if($atividade->participantes->where('user.passaporte', $attributes['passaporte'])->first()){
                return redirect(Route('participante.index', ['atividade_id' => $attributes['atividade_id']]))
                                ->with(['error_mensage' => 'Não é possível adicionar o mesmo participante mais de uma vez na mesma atividade!']);
            }
        }


        try{
            $user = $this->createUser($attributes);

        } catch (ValidationException $exception) {
            return redirect()->back()->withErrors($exception->validator)->withInput();
        }

        $attributes['user_id'] = $user->id;
        Participante::create($attributes);

        return redirect(Route('participante.index', ['atividade_id' => $attributes['atividade_id']]))
            ->with(['mensagem' => 'Participante cadastrado com sucesso']);
    }

    public function requisicao(Request $request)
    {
        $attributes = $request->all();


            $instituicao = Instituicao::where('nome', $attributes['instituicao'])->first();

            $attributes['instituicao'] = $instituicao ? $instituicao->nome : "Outras";
            $attributes['instituicao_id'] = $instituicao? $instituicao->id : 2;

        try {
            ParticipanteValidator::validate($attributes);
        } catch (ValidationException $exception) {
            return redirect(route('participante.create', ['atividade_id' => $attributes['atividade_id'], 'cpf' => $attributes['cpf'], 'passaporte' => $attributes['passaporte']]))
                ->withErrors($exception->validator)->withInput();
        }

        $atividade = Atividade::find($attributes['atividade_id']);


        if($attributes['cpf']){
            if($atividade->participantes->where('user.cpf', $attributes['cpf'] )->first()){
                return redirect(Route('participante.index', ['atividade_id' => $attributes['atividade_id']]))
                    ->with(['error_mensage' => 'Não é possível adicionar o mesmo participante mais de uma vez na mesma atividade!']);
            }
        }

        if($attributes['passaporte']){
            if($atividade->participantes->where('user.passaporte', $attributes['passaporte'])->first()){
                return redirect(Route('participante.index', ['atividade_id' => $attributes['atividade_id']]))
                    ->with(['error_mensage' => 'Não é possível adicionar o mesmo participante mais de uma vez na mesma atividade!']);
            }
        }

        $info_extra = [
            'tipo' => $attributes['tipo'],
            'disciplina'=> $attributes['disciplina'],
            'orientador'=> $attributes['orientador'],
            'periodo_letivo'=> $attributes['periodo_letivo'],
            'area'=> $attributes['area'],
            'local_realizado'=> $attributes['local_realizado'],
            'titulo_projeto'=> $attributes['titulo_projeto']
        ];
        $info_extra = InfoExternaParticipante::create($info_extra);
        $info_extra->save();



        try{

            $user = $this->createUser($attributes);


        } catch (ValidationException $exception) {
            return redirect()->back()->withErrors($exception->validator)->withInput();
        }

        $attributes['user_id'] = $user->id;
        $attributes['info_externa_participante_id'] = $info_extra->id;

        $participante = Participante::create($attributes);

        return response(['participante' => $participante]);;
    }

    private function createUser($attributes)
    {

        if($attributes['cpf']){
            $user = User::where('cpf', $attributes['cpf'])->first();
        }

        if($attributes['passaporte']){
            $user = User::where('passaporte', $attributes['passaporte'])->first();
        }

        if ($user)
            return $user;

        $password = Str::random(15);

        $userAttributes = [
            'name' => $attributes['nome'],
            'email' => $attributes['email'],
            'cpf' => $attributes['cpf'],
            'passaporte' => $attributes['passaporte'],
            'instituicao_id' => $attributes['instituicao_id'] ?? 2,
            'instituicao' => $attributes['instituicao'] ?? "Outras",
            'password' => Hash::make($password),
            'perfil_id' => 4,
            'cadastro_finalizado' => false,
            'json_cursos_ids' => $attributes['json_cursos_ids'] ?? null

        ];




        $userAttributes['password_confirmation'] = $userAttributes['password'];


        DefaultValidator::validate($userAttributes, User::$rules, User::$messages);

        if($attributes['cpf']){
            DefaultValidator::validate($userAttributes, ['cpf' => ($userAttributes['passaporte'] == NULL ? ['required',new Cpf] : 'nullable')], User::$messages);
        }

        if($attributes['passaporte']){
            DefaultValidator::validate($userAttributes, ['passaporte' => ($userAttributes['cpf'] == NULL ? ['required','max:10'] : 'nullable')], User::$messages);
        }




        //enviar o email informando a senha
        /* Mail::to($userAttributes['email'], $userAttributes['name'])->send(new UsuarioNaoCadastrado([
            'email'    => $userAttributes['email'],
            'password' => $password,
        ])); */


        return User::create($userAttributes);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Participante $participante
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Participante $participante
     * @return \Illuminate\Http\Response
     */
    public function edit($participante_id)
    {
        $participante = Participante::findOrFail($participante_id);

        $atividade = Atividade::findOrFail($participante->atividade_id);

        if(Auth::user()->perfil_id == 3)
        {
            return view('gestor_institucional.participante_edit', ['participante' => $participante, 'atividade' => $atividade]);
        }
        else
        {
            return view('participante.participante_edit', ['participante' => $participante, 'atividade' => $atividade]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateParticipanteRequest $request
     * @param \App\Models\Participante $participante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            ParticipanteValidator::validate($request->all(), Participante::$editRules);
        } catch (ValidationException $exception) {
            return redirect(route('participante.edit', ['participante_id' => $request->id]))
                ->withErrors($exception->validator)->withInput();
        }

        $participante = Participante::findOrFail($request->id);

        if(Auth::user()->perfil_id == 3)
        {
            $usuario = User::findOrFail($participante->user_id);

            $usuario->name = $request->nome;
            $usuario->email = $request->email;

            if($usuario->cpf)
            {
                $usuario->cpf = $request->cpf;
            }
            else
            {
                $usuario->passaporte = $request->passaporte;
            }

            $usuario->update();
        }

        //$participante->titulo = $request->titulo;
        $participante->carga_horaria = $request->carga_horaria;
        $participante->atividade_id = $request->atividade_id;

        $participante->update();

        return redirect(Route('participante.index', ['atividade_id' => $request->atividade_id]))
            ->with(['mensagem' => 'Participante editado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Participante $participante
     * @return \Illuminate\Http\Response
     */
    public function delete($participante_id)
    {
        $participante = Participante::findOrFail($participante_id);
        $participante->delete();

        return redirect(Route('participante.index', ['atividade_id' => $participante->atividade_id]))->with(['mensagem' => 'Participante excluido com sucesso']);
    }

    public function participantes_atividade($atividade_id)
    {
        $participantes = Participante::all()->where('atividade_id', $atividade_id)->sortBy('id');
        $atividade = Atividade::find($atividade_id);

        return view('gestor_institucional.participantes_acao', ['participantes' => $participantes, 'atividade' => $atividade]);
    }

    public function participante_certificados()
    {
        $naturezas = Natureza::all();

        return view('participante.certificados', compact('naturezas'));
    }

    public function filtro(){
        $participacoes = Auth::user()->participacoes;


        if(request('buscar_acao')){

            $participacoes = Participante::search_acao($participacoes, request('buscar_acao'));
        }


        if(request('data')){
            $participacoes = Participante::search_data($participacoes, request('data'));
        }

        if(request('natureza')){
            $participacoes = Participante::search_natureza($participacoes, request('natureza'));
        }

        return view('participante.list_certificados',compact('participacoes'));
    }


    public function import_participantes(ImportParticipantesRequest $request, $atividade_id){
        try {
            $atividade = Atividade::find($atividade_id);
    
            $inputFileType = IOFactory::identify($request->participantes_xlsx);
            $reader = IOFactory::createReader($inputFileType);
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($request->participantes_xlsx);
            $worksheet = $spreadsheet->getActiveSheet();
    
            $highestRow = $worksheet->getHighestDataRow(); // e.g. 10
    
            $participantes = [];
    
            for ($row = 2; $row <= $highestRow; ++$row) {
                //$row[0] => Nome | $row[1] = CPF | $row[2] = E-mail | $row[3] = CH
                $cpf = Mask::mask($worksheet->getCell([2, $row])->getValue(), "###.###.###-##");
                $user = User::where('cpf', '=', $cpf)->first();
    
                $confirm = True;
    
                if(!$user)
                {
                    try{
    
                        $attributes = [
                            'nome' => $worksheet->getCell([1, $row])->getValue(),
                            'cpf'  => $cpf,
                            'passaporte' => NULL,
                            'email' => $worksheet->getCell([3, $row])->getValue(),
                            'perfil_id' => 4,
                            'instituicao' => 'outra',
                            'instituicao_id' => 2,
                        ];
    
                        $user = $this->createUser($attributes);
    
                    } catch (\Throwable $th) {
                        $confirm = False;
    
                        $message = $worksheet->getCell([1, $row])->getValue()." (".$th->getMessage().")";
    
                        array_push($participantes, $message);
                    }
                }
    
    
                if($confirm && !$user->participacoes()->where('atividade_id', '=', $atividade->id)->first())
                {
                    $participante = new Participante();
                    $participante->carga_horaria = $worksheet->getCell([4, $row])->getValue();
                    $participante->atividade_id = $atividade_id;
                    $participante->user_id = $user->id;
    
                    $participante->save();
                }
    
            }
    
    
    
            $mensagem = "Participantes adicionados!";
    
            if($participantes){
                $mensagem = "Os seguintes participantes não puderam ser adicionados:\n"
                            .implode("  /  ",$participantes).".\n".
                            "\n Verifique os dados dos participantes e tente novamente.";
                return redirect(route('participante.index', ['atividade_id' => $atividade_id]))->with(['alert_mensage' => $mensagem]);
            }
    
            return redirect(route('participante.index', ['atividade_id' => $atividade_id]))->with(['mensagem' => $mensagem]);
        } catch (Exception $exception) {
            $trackingId = (string) Str::uuid();

            // Registra a exceção com o identificador nos logs
            \Illuminate\Support\Facades\Log::error("Error [$trackingId]: " . $exception->getMessage(), [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ]);

            return redirect()->back()->withErrors("Ocorreu um erro no processamento do arquivo.<br>Identificador do Erro: $trackingId");
        }
    }

    /**
     * @throws Exception
     */
    public function import_trabalhos($atividade_id, Request $request){
        $atividade = Atividade::find($atividade_id);

        $inputFileType = IOFactory::identify($request->trabalhos_xlsx);

        $reader = IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);

        $spreadsheet = $reader->load($request->trabalhos_xlsx);

        $worksheet = $spreadsheet->getActiveSheet();



        $highestRow = $worksheet->getHighestDataRow(); // e.g. 10

        $participantes = [];

        for ($row = 2; $row <= $highestRow; ++$row) {

            //$row[1] => Titulo Trabalho | $row[2] = Carga Horaria Trabalho | $row[3] = Autor | $row[4] = NOME | $row[5] = E-MAIL | $row[6] = cpf
            $trabalho = new Trabalho();
            $trabalho->titulo = $worksheet->getCell([1, $row])->getValue();
            $trabalho->carga_horaria = $worksheet->getCell([2, $row])->getValue();
            $trabalho->atividade_id = $atividade_id;

            $trabalho->save();

            $cell = 3;
            $tipo_autor = $worksheet->getCell([$cell, $row])->getValue();
            if($tipo_autor !== null && (strtoupper($tipo_autor) === "AUTOR"||
                    strtoupper($tipo_autor) === "COAUTOR")){
            do{

                $cpf = Mask::mask($worksheet->getCell([$cell + 3, $row])->getValue(), "###.###.###-##");
                $user = User::where('cpf', '=', $cpf)->first();

                $confirm = True;

                if(!$user)
                {
                    try{

                        $attributes = [
                            'nome' => $worksheet->getCell([$cell+1, $row])->getValue(),
                            'cpf'  => $cpf,
                            'passaporte' => NULL,
                            'email' => $worksheet->getCell([$cell+2, $row])->getValue(),
                            'perfil_id' => 4,
                            'instituicao' => 'Outra',
                            'instituicao_id' => 2,
                        ];



                        $user = $this->createUser($attributes);

                    } catch (\Throwable $th) {
                        $confirm = False;

                        $message = $worksheet->getCell([$cell+1, $row])->getValue()." (".$th->getMessage().")";

                        array_push($participantes, $message);
                    }
                }


                if ($confirm &&
                    (
                        !$user->participacoes()->where('autor_trabalhos_id', '=', $trabalho->id)->first() ||
                        !$user->participacoes()->where('coautor_trabalhos_id', '=', $trabalho->id)->first()
                    ) )
                {
                    $participante = new Participante();
                    $participante->carga_horaria = $worksheet->getCell([2, $row])->getValue();
                    $participante->atividade_id = $atividade_id;
                    $participante->user_id = $user->id;

                    if(strtoupper($worksheet->getCell([$cell, $row])->getValue()) === "AUTOR"){
                        $participante->autor_trabalhos_id = $trabalho->id;
                    }else{
                        $participante->coautor_trabalhos_id = $trabalho->id;
                    }

                    $participante->save();
                }

                $cell = $cell + 4;

            }while($worksheet->getCell([$cell, $row])->getValue() !== null && (strtoupper($worksheet->getCell([$cell, $row])->getValue()) === "AUTOR" ||
                strtoupper($worksheet->getCell([$cell, $row])->getValue()) === "COAUTOR"));
        }
        }



        $mensagem = "Trabalhos e autores adicionados!";

        if($participantes){
            $mensagem = "Os seguintes participantes não puderam ser adicionados:\n"
                .implode("  /  ",$participantes).".\n".
                "\n Verifique os dados dos participantes e tente novamente.";
            return redirect(route('trabalho.index', ['atividade_id' => $atividade_id]))->with(['alert_mensage' => $mensagem]);
        }

        return redirect(route('trabalho.index', ['atividade_id' => $atividade_id]))->with(['mensagem' => $mensagem]);
    }

}
