<?php

namespace App\Http\Controllers;

use App\Models\Assinatura;
use App\Http\Requests\StoreAssinaturaRequest;
use App\Http\Requests\UpdateAssinaturaRequest;
use App\Models\User;
use App\Validates\AssinaturaValidator;
use Illuminate\Validation\ValidationException;

class AssinaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assinaturas = Assinatura::query()->get();
        return view('assinatura.assinatura_consult',['assinaturas' => $assinaturas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users  = User::orderBy('name')->get();
        return view('assinatura.assinatura_create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssinaturaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssinaturaRequest $request)
    {
        #TipoNatureza::create($request->all());
        #validate
        try {
            AssinaturaValidator::validate($request->all());
        } catch (ValidationException $exception) {
            return redirect(route('assinatura.create'))->withErrors($exception->validator)->withInput();
        }


        
        $assinatura = new Assinatura();
        
        #$ext = $request->img_assinatura->getClientOriginalExtension();
        $assinatura->user_id = $request->user_id;
        $assinatura->img_assinatura = $request->img_assinatura->store('public/Assinaturas');
        $assinatura->save();

        return redirect(Route('assinatura.show'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function show(Assinatura $assinatura)
    {
        $assinaturas = Assinatura::query()->get();
        return view('assinatura.assinatura_consult',['assinaturas' => $assinaturas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assinatura = Assinatura::query()->findOrFail($id);
        return view('assinatura.assinatura_edit', ['assinatura' => $assinatura]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssinaturaRequest  $request
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssinaturaRequest $request, $id)
    {
        $assinatura = Assinatura::query()->findOrFail($id);
        
        $assinatura->update([
            'img_assinatura' => $request->img_assinatura,
            'ususario_id' => $request->usuario_id
        ]);
        
        return redirect(Route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assinatura  $assinatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assinatura = Assinatura::query()->findOrFail($id);

        $assinatura->delete();

        return redirect(Route('home'));
    }
}
