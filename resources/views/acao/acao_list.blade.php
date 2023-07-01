@foreach ($acoes as $acao)
    <div class="row linha-table d-flex align-items-center justify-content-start">
        <div class="col-4 titulo-span text-start"><span class="spacing-col">{{ $acao->titulo }}</span></div>
        <div class="col-2 text-center"><span>{{date( 'd/m/Y' , strtotime($acao->data_inicio)).' - '.date( 'd/m/Y' , strtotime($acao->data_fim))}}</span></div>
        <div class="col-1 text-center"><span>{{ $acao->status }}</span></div>
        <div class="col-1 text-center"><span>{{$acao->tipo_natureza->natureza->descricao}}</span></div>
        <div class="col-2 text-center">
            <span>
                @if ($acao->anexo != null)
                    <a href="{{ route('anexo.download', ['acao_id' => $acao->id]) }}">
                        <img style="opacity: 0.5" src="/images/acoes/listView/anexo.svg"alt="Visualizar">
                    </a>
                @endif
            </span>
        </div>
        <div class="col-2 d-flex align-items-center justify-content-evenly">
            <span><a href=""><img src="/images/acoes/listView/eye.svg" alt="Visualizar dados"></a></span>
            <span><a href="{{ Route('atividade.index', ['acao_id' => $acao->id]) }}"><img src="/images/acoes/listView/atividade.svg" alt="Atividades"></a></span>
            @if ($acao->status == null)
                <span><a href="{{ Route('acao.edit', ['acao_id' => $acao->id]) }}"><img src="/images/acoes/listView/editar.svg" alt="Editar"></a></span>
                <span><a href="{{ Route('acao.delete', ['acao_id' => $acao->id]) }}"><img src="/images/acoes/listView/lixoIcon.svg" alt="Excluir"></a></span>
                @if(Auth::user()->perfil_id == 3)
                    <span><a href="{{ Route('gestor.gerar_certificados', ['acao_id' => $acao->id]) }}"><img src="/images/acoes/listView/submeter.svg" alt="emitir certificados"></a></span>
                @else
                <span><a href="{{ Route('acao.submeter', ['acao_id' => $acao->id]) }}"><img src="/images/acoes/listView/submeter.svg" alt="submeter"></a></span>
                @endif

            @elseif($acao->status == 'Aprovada')
                <a href="{{ route('certificados.download', ['acao_id' => $acao->id]) }}"><img src="/images/acoes/listView/zipcertificados.svg" alt=""></a>
            @endif

        </div>
    </div>
@endforeach