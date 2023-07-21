@foreach ($acoes as $acao)
    <div class="row linha-table d-flex align-items-center justify-content-start">
        <div class="col-5 titulo-span text-start"><span class="spacing-col">{{ $acao->titulo }}</span></div>
        <div class="col-1 text-center"><span>{{$acao->tipo_natureza->natureza->descricao}}</span></div>
        <div class="col-2 text-center"><span>{{$acao->tipo_natureza->descricao}}</span></div>
        <div class="col-1 text-center tag tag-{{$acao->status}}"><span>{{ $acao->status }}</span></div>
        <div class="col-1 text-center">
            <span>
                @if ($acao->anexo != null)
                    <a href="{{ route('anexo.download', ['acao_id' => $acao->id]) }}" title="Baixar Anexo">
                        <img src="/images/acoes/listView/anexo.svg"alt="Visualizar">
                    </a>
                @endif
            </span>
        </div>
        <div class="col-2 d-flex align-items-center justify-content-evenly">
            <span><a href=""><img src="/images/acoes/listView/eye.svg" alt="Visualizar dados" title="Visualizar Ação"></a></span>
            <span><a href="{{ Route('atividade.index', ['acao_id' => $acao->id]) }}"><img src="/images/acoes/listView/atividade.svg" alt="Atividades" title="Atividades"></a></span>
            @if ($acao->status == null)
                <span><a href="{{ Route('acao.edit', ['acao_id' => $acao->id]) }}"><img src="/images/acoes/listView/editar.svg" alt="Editar" title="Editar Ação"></a></span>
                <span><a onclick="return confirm('Você tem certeza que deseja excluir esta ação?')" href="{{ Route('acao.delete', ['acao_id' => $acao->id]) }}" title="Excluir Ação"><img src="/images/acoes/listView/lixoIcon.svg" alt="Excluir"></a></span>
                @if(Auth::user()->perfil_id == 3)
                    <span><a href="{{ Route('gestor.gerar_certificados', ['acao_id' => $acao->id]) }}"><img src="/images/acoes/listView/submeter.svg" alt="emitir certificados" title="Submeter Ação"></a></span>
                @else
                <span><a onclick="return confirm('Você tem certeza que deseja submeter esta ação?')" href="{{ Route('acao.submeter', ['acao_id' => $acao->id]) }}"><img src="/images/acoes/listView/submeter.svg" alt="submeter" title="Submeter Ação"></a></span>
                @endif

            @elseif($acao->status == 'Aprovada')
                <a href="{{ route('certificados.download', ['acao_id' => $acao->id]) }}"><img src="/images/acoes/listView/zipcertificados.svg" alt="" title="Baixar Certificados"></a>
            @endif

        </div>
    </div>
@endforeach