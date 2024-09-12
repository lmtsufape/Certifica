<?php

namespace App\Http\Controllers;

use App\Models\CertificadoModelo;
use App\Http\Requests\StoreCertificadoModeloRequest;
use App\Http\Requests\UpdateCertificadoModeloRequest;
use App\Models\UnidadeAdministrativa;
use App\Models\TipoAtividade;
use App\Validates\CertificadoModeloValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class CertificadoModeloController extends Controller
{
    /**
     * Display a listing of the resource.bv
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->perfil_id == 1) {
            $certificado_modelos = CertificadoModelo::query()->where('tipo_certificado', '=', null )->get();

            return view('certificado_modelo.certificado_modelo_index', ['certificado_modelos' => $certificado_modelos]);
        } elseif (Auth::user()->perfil_id == 3) {
            $certificado_modelos = CertificadoModelo::all()->where('tipo_certificado', '!=', null)->
            where('unidade_administrativa_id', Auth::user()->unidade_administrativa_id)->sortBy('id');

            return view('certificado_modelo.certificado_modelo_index', ['certificado_modelos' => $certificado_modelos]);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = UnidadeAdministrativa::orderBy('id')->get();
        return view('certificado_modelo.certificado_modelo_create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreCertificadoModeloRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificadoModeloRequest $request)
    {
        #TipoNatureza::create($request->all());
        #validate
        try {
            CertificadoModeloValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('certificado_modelo.create'))->withErrors($exception->validator)->withInput();
        }

        $certificado_modelo = new CertificadoModelo();

        $certificado_modelo->unidade_administrativa_id = $request->unidade_adm;
        $certificado_modelo->descricao = $request->descricao;
        $certificado_modelo->texto = $request->texto;
        $certificado_modelo->fundo = $request->fundo->store('public/modelos');
        $certificado_modelo->verso = $request->verso->store('public/modelos');

        $certificado_modelo->save();

        $certificado_modelos = CertificadoModelo::all();
        return redirect(route('certificado_modelo.index'))->with(['mensagem' => 'Modelo de certificado cadastrado com sucesso']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Assinatura $assinatura
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelo = CertificadoModelo::find($id);
        $img = Storage::url($modelo->fundo);
        $verso = Storage::url($modelo->verso);

        return view('certificado_modelo.certificado_modelo_show', ['modelo' => $modelo, 'imagem' => $img, 'verso' => $verso]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Assinatura $assinatura
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidades = UnidadeAdministrativa::orderBy('descricao')->get();
        $modelo = CertificadoModelo::find($id);
        $fundo = Storage::url($modelo->fundo);
        $verso = Storage::url($modelo->verso);

        $tipos_certificado = ['Avaliador(a)', 'Bolsista', 'Colaborador(a)', 'Comissão Organizadora', 'Conferencista', 'Coordenador(a)', 'Formador(a)', 'Ministrante', 'Orientador(a)',
            'Palestrante', 'Voluntário(a)', 'Participante', 'Vice-coordenador(a)', 'Ouvinte', 'Apresentação de Trabalho', 'Monitoria', 'Tutoria', 'Bolsas de Icentivo Acadêmico',
            'Programa de Atividades de Vivência Interdisciplinar'];
        sort($tipos_certificado);

        $tipoAtividade = TipoAtividade::all();

        $tipoAtividadeNames = $tipoAtividade->pluck('name')->toArray();
        $tipos_ordenados = array_merge($tipos_certificado, $tipoAtividadeNames);
        sort($tipos_ordenados);

        return view('certificado_modelo.certificado_modelo_edit',compact('unidades','modelo','fundo','verso', 'tipos_ordenados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCertificadoModeloRequest $request
     * @param \App\Models\Assinatura $assinatura
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificadoModeloRequest $request, $id)
    {
        try {
            if (isset($request->fundo)) {
                CertificadoModeloValidator::validate($request->all());
            } else {
                CertificadoModeloValidator::validate($request->all(), CertificadoModelo::$edit_rules);
            }
        } catch (ValidationException $exception) {
            return redirect(route('certificado_modelo.edit', ['id' => $id]))->withErrors($exception->validator)->withInput();
        }

        $modelo = CertificadoModelo::find($id);

        if (isset($request->fundo) && isset($request->verso)) //caso as imagens da frente e verso tenham sido mudadas
        {
            $modelo->fundo = $request->fundo->store('public/modelos');
            $modelo->verso = $request->verso->store('public/modelos');
        } elseif(isset($request->fundo)) //caso a imagem da frente tenha sido mudada
        {
            $modelo->fundo = $request->fundo->store('public/modelos');
        }
         elseif(isset($request->verso)) //caso a imagem do verso tenha sido mudada
        {
            $modelo->verso = $request->verso->store('public/modelos');
        }

        if($request->tipo_certificado == 'Outro') {
            $modelo->tipo_certificado = $request->outro;
        } else {
            $modelo->tipo_certificado = $request->tipo_certificado;
        }

        $modelo->descricao = $request->descricao;
        $modelo->texto = $request->texto;
        $modelo->texto_um_dia = $request->texto_um_dia;

        $modelo->update();

        return redirect(route('certificado_modelo.index'))->with(['mensagem' => "Modelo atualizado com sucesso"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CertificadoModelo $assinatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificado_modelo = CertificadoModelo::query()->findOrFail($id);

        try {
            $certificado_modelo->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("Este modelo não pode ser excluído! O modelo está associado a um ou mais certificados.");
        }

        return redirect(Route('certificado_modelo.index'))->with(['mensagem' => 'Modelo excluido com sucesso']);
    }

    public function showImg($id, $imagem)
    {
        $modelo = CertificadoModelo::find($id);

        if ($imagem == 'fundo')
        {
            $img = Storage::url($modelo->fundo);
        } elseif($imagem == 'verso')
        {
            $img = Storage::url($modelo->verso);
        }

        return view('certificado_modelo.certificado_modelo_img', ['modelo' => $modelo, 'imagem' => $img]);
    }

    public function create_tipo_certificado()
    {
        $tipos_certificado = ['Avaliador(a)', 'Bolsista', 'Colaborador(a)', 'Comissão Organizadora', 'Conferencista', 'Coordenador(a)', 'Formador(a)', 'Ministrante', 'Orientador(a)',
            'Palestrante', 'Voluntário(a)', 'Participante', 'Vice-coordenador(a)', 'Ouvinte', 'Apresentação de Trabalho', 'Monitoria', 'Tutoria', 'Bolsas de Icentivo Acadêmico',
            'Programa de Atividades de Vivência Interdisciplinar'];

        $tipoAtividade = TipoAtividade::all();

        $tipoAtividadeNames = $tipoAtividade->pluck('name')->toArray();
        $tipos_ordenados = array_merge($tipos_certificado, $tipoAtividadeNames);
        sort($tipos_ordenados);

        $modelo = CertificadoModelo::where('unidade_administrativa_id', Auth::user()->unidade_administrativa_id)->first();

        if($modelo == null)
        {
            return redirect(Route('certificado_modelo.index'))->with(['mensagem' => 'Essa Unidade Administrativa não possui um modelo de certificado cadastrado']);
        }


        $unidade_adm = UnidadeAdministrativa::findOrFail($modelo->unidade_administrativa_id);

        $img_fundo = Storage::url($modelo->fundo);
        $img_verso = Storage::url($modelo->verso);

        return view('certificado_modelo.tipo_certificado_modelo_create', ['tipos_ordenados' => $tipos_ordenados,
            'modelo' => $modelo, 'unidade_adm' => $unidade_adm, 'img_fundo' => $img_fundo, 'img_verso' => $img_verso,
        ]);
    }

    public function store_tipo_certificado(Request $request)
    {
        if($request->tipo_certificado == 'Outro')
        {
            $certificado_modelo = new CertificadoModelo();

            $certificado_modelo->unidade_administrativa_id = $request->unidade_administrativa_id;
            $certificado_modelo->descricao = $request->descricao;
            $certificado_modelo->tipo_certificado = $request->outro;
            $certificado_modelo->texto = $request->texto;
            $certificado_modelo->texto_um_dia = $request->texto_um_dia;
            $certificado_modelo->fundo = $request->fundo;
            $certificado_modelo->verso = $request->verso;

            $certificado_modelo->save();

            return redirect(route('home'))->with(['mensagem' => 'Modelo de certificado cadastrado com sucesso']);
        } else
        {
            $certificado_modelo = new CertificadoModelo();

            $certificado_modelo->unidade_administrativa_id = $request->unidade_administrativa_id;
            $certificado_modelo->descricao = $request->descricao;
            $certificado_modelo->tipo_certificado = $request->tipo_certificado;
            $certificado_modelo->texto = $request->texto;
            $certificado_modelo->texto_um_dia = $request->texto_um_dia;
            $certificado_modelo->fundo = $request->fundo;
            $certificado_modelo->verso = $request->verso;

            $certificado_modelo->save();

            return redirect(route('home'))->with(['mensagem' => 'Modelo de certificado cadastrado com sucesso']);
        }

    }
}
