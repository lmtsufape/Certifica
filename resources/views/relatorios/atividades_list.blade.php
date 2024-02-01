@foreach($atividades as $atividade)

    <div class="row linha-table d-flex align-items-center justify-content-start">
        <div class="col-3 text-center titulo-span" title="{{$atividade->descricao}}"><span>{{$atividade->descricao}}</span></div>
        <div class="col-3">
                        <span>{{ collect(explode('-', $atividade->data_inicio))->reverse()->join('/') .
                            ' - ' .
                            collect(explode('-', $atividade->data_fim))->reverse()->join('/') }}</span>
        </div>
        <div class="col-4 titulo-span" title="{{ $atividade->lista_nomes }}">
            {{ $atividade->nome_participantes }}
        </div>
        <div class="col-2 text-center"><span>{{$atividade->total}}</span></div>

    </div>
@endforeach
