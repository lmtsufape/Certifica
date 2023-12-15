@foreach ($acaos as $acao)
    <div class="row linha-table d-flex align-items-center justify-content-start">
        <div class="col-4 text-center titulo-span">
            <span class="spacing-col">
                {{ $acao->titulo }}
            </span>
        </div>
        <div class="col-4 text-center">
            <div class="row justify-content-center">
                <div class="tag tag-{{$acao->status}} col-3">
                    <span>{{ $acao->status }}</span>
                </div>
            </div>
        </div>

        <div class="col-4 text-center">
            <span style="padding-right:10px;">
                <a href="{{ route('gestor.analisar_acao', ['acao_id' => $acao->id]) }}">
                    <img src="/images/acoes/listView/eye.svg" alt="Visualizar açao" title="Visualizar ação"></a>
            </span>
            <span style="padding-right:3px;">
                <a href="{{ route('acao.edit', ['acao_id' => $acao->id]) }}">
                    <img src="/images/acoes/listView/editar.svg" alt="Editar ação" title="Editar ação"></a>
            </span>
            <span style="padding-left:10px;">
                <a href="" data-bs-toggle="modal" data-bs-target="#modal-info{{$acao->id}}">
                    <img src="/images/acoes/listView/clipboard-check.svg" alt="Finalizar solicitação" title="Finalizar solicitação"></a>
            </span>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modal-info{{$acao->id}}" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">
                <div class="modal-header" style="background: #972E3F; color: white;">
                    <h5 class="modal-title"><b>Finalizar Solicitação</b></h5>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formAnaliseAcao" name="formAnaliseAcao" action="{{ route('gestor.acao_update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $acao->id }}">

                        <div class="container">
                            <div class="row">
                                @if($acao->status == "Em análise")
                                    <div class="form-group">
                                        <label for="observacoes">Observações:</label>
                                        <textarea class="form-control" id="observacao_gestor" name="observacao_gestor" rows="3"></textarea>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="observacoes">Observações:</label>
                                        <textarea class="form-control" id="observacao_gestor" name="observacao_gestor" rows="3" disabled>{{ $acao->observacao_gestor }}</textarea>
                                    </div>
                                @endif


                                <div class="col d-flex align-items-center justify-content-evenly mt-4">
                                    <div>
                                        <button name="action" type="submit" class="button btn-danger buttonAnalisar" value="reprovar">Reprovar</button>
                                        <button name="action" type="submit" class="button btn-secondary buttonAnalisar" value="devolver">Devolver</button>
                                        <button name="action" type="submit" class="button buttonAnalisar" value="aprovar">Aprovar</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
