@foreach($participacoes as $participacao)
    <div class="row linha-table d-flex align-items-center justify-content-start">
        <div class="col-3 titulo-span text-center"><span class="spacing-col">{{$participacao->atividade->acao->titulo}}</span></div>
        <div class="col-2 text-center"><span>{{$participacao->atividade->data_inicio.' - '.$participacao->atividade->data_fim}}</span></div>
        <div class="col-2 text-center titulo-span"><span>{{$participacao->atividade->descricao}}</span></div>
        <div class="col-2 text-center"><span>{{$participacao->atividade->acao->tipo_natureza->descricao}}</span></div>
        <div class="col-2 d-flex align-items-center justify-content-evenly">
            <span> <a href="{{route('participante.ver_certificado_participante', ['id' => $participacao->id])}}" target="blank">
                        <img src="/images/acoes/listView/certificado.svg" alt="Visualizar">
                    </a>
            </span>
        </div>
    </div>
@endforeach