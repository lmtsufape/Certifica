@foreach($participacoes as $participacao)
    <div class="row linha-table d-flex align-items-center justify-content-start">
        <div class="col-3 titulo-span text-center"><span class="spacing-col">{{$participacao->atividade->acao->titulo}}</span></div>
        <div class="col-2 text-center"><span>{{date( 'd/m/Y' , strtotime($participacao->atividade->data_inicio)).' - '.date( 'd/m/Y' , strtotime($participacao->atividade->data_fim))}}</span></div>
        <div class="col-2 text-center titulo-span"><span>{{$participacao->atividade->descricao}}</span></div>
        <div class="col-2 text-center"><span>{{$participacao->atividade->acao->tipo_natureza->natureza->descricao}}</span></div>
        
        @if($participacao->atividade->acao->status)
            <div class="col-1 d-flex align-items-end justify-content-end">
                <span> <a href="{{route('participante.ver_certificado_participante', ['id' => $participacao->id])}}" target="blank">
                            <img src="/images/acoes/listView/certificado.svg" alt="Visualizar" title="Baixar Certificado">
                        </a>
                </span>
            </div>
        @endif
        <div class="col-1 d-flex align-items-start justify-content-start  ">
            <span>
                <a href='#' onclick="setaDadosModal({{$participacao}})">
                    <img src="/images/acoes/listView/eye.svg" alt="Visualizar{{$participacao}}" title="Detalhes">
                </a>
            </span>
        </div>
    </div>
@endforeach

