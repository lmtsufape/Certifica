<?php

namespace App\Http\Controllers;

use App\Models\Assinatura;
use App\Http\Requests\StoreAssinaturaRequest;
use App\Http\Requests\UpdateAssinaturaRequest;

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
        return view('assinatura.assinatura_create');
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

        $assinatura = new Assinatura();

        $assinatura->usuario_id = $request->usuario_id;
        $assinatura->img_assinatura = $request->img_assinatura;

        $assinatura->save();

        return redirect(Route('home'));
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
