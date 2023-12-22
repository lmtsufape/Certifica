<!-- @foreach($certificados as $certificado)
    <div class="row linha-table d-flex align-items-center justify-content-start">
        <div class="col-3 titulo-span text-center"><span class="spacing-col">{{$certificado->atividade->acao->tipo_natureza->natureza->descricao}}</span></div>
        <div class="col-2 text-center"><span>{{$certificado->atividade->acao->tipo_natureza->descricao}}</span></div>
        <div class="col-2 text-center titulo-span"><span>{{$certificado->atividade->acao->titulo}}</span></div>
        <div class="col-2 text-center"><span>{{$certificado->atividade->descricao}}</span></div>
        <div class="col-2 d-flex align-items-center justify-content-evenly">
            <span> <a href="{{route('participante.ver_certificado', ['participante_id'=>$certificado->participante($certificado->atividade_id, $certificado->cpf_participante)->id])}}" target="blank">
                        <img src="/images/acoes/listView/certificado.svg" alt="Visualizar">
                    </a>
            </span>
        </div>
    </div>
@endforeach -->
@foreach($acoes as $acao)
    <div class="row linha-table d-flex align-items-center justify-content-start">
        <div class="col-2 text-center titulo-span" title="{{$acao->titulo}}"><span>{{$acao->titulo}}</span></div>
        <div class="col-2 titulo-span text-center"><span class="spacing-col">{{$acao->tipo_natureza->natureza->descricao}}</span></div>
        <div class="col-2 text-center titulo-span" title="{{$acao->tipo_natureza->descricao}}"><span>{{$acao->tipo_natureza->descricao}}</span></div>
        <div class="col-2 text-center titulo-span" title="{{$acao->nome_atividades}}"><span>{{$acao->nome_atividades}}</span></div>
        <div class="col-1 text-center"><span>{{$acao->total}}</span></div>
        <div title="{{ $acao->unidadeAdministrativa->descricao }}" class="col-1 text-center titulo-span"><span>{{ $acao->unidadeAdministrativa->descricao }}</span></div>
        <div class="col-2 text-center">
            <span> 
                <a data-toggle="modal" data-target="#modal-info{{ $acao->id }}"><img
                        src="/images/acoes/listView/eye.svg" alt="Visualizar dados" title="Visualizar Ação"></a></span>
                    </a>
                
                <a href="{{route('certificados.download', ['acao_id'=>$acao->id])}}" target="blank">
                        <img src="/images/acoes/listView/zipcertificados.svg" alt="Visualizar" title="Baixar Certificados">
                    </a>
            </span>
        </div>
    </div>
    <div class="modal fade" id="modal-info{{ $acao->id }}">

<div class="modal-dialog modal-dialog-centered" role="dialog">

    <div class="modal-content">
        <div class="modal-header" style="background: #972E3F; color: white;">
            <h5 class="modal-title"><b>Detalhes da Ação Institucional</b></h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <span><strong>Título: </strong>{{ $acao->titulo }}</span>
                <span><b>Natureza: </b>{{ $acao->tipo_natureza->natureza->descricao }}</span>
                <span><b>Tipo da Natureza: </b>{{ $acao->tipo_natureza->descricao }}</span>
                <span><b>Status: </b>
                    @if ($acao->status)
                        {{ $acao->status }}
                    @else
                        Não submetida
                    @endif
                </span>
                <span><b>Inicio: </b>{{ date('d/m/Y', strtotime($acao->data_inicio)) }}</span>
                <span><b>Fim: </b>{{ date('d/m/Y', strtotime($acao->data_fim)) }}</span>
                @if ($acao->anexo)
                    <span><b>Anexo: </b>
                        <a href="{{ route('anexo.download', ['acao_id' => $acao->id]) }}" title="Baixar Anexo">
                            <img src="/images/acoes/listView/anexo.svg" alt="Visualizar">
                        </a>
                    </span>
                @endif
                @if ($acao->observacao_gestor)
                    <span><b>Observações do Gestor: </b>{{ $acao->observacao_gestor }}</span>
                @endif
                <span><b>Quantidade de Certificados: </b>{{ $acao->total}}</span>
                <span><b>Emissor: </b>{{ $acao->unidadeAdministrativa->descricao }}</span>
            </div>

            @if (count($acao->atividades))
                <hr>
                <div class="row justify-content-center">
                    <h5>Atividades</h5>
                    @foreach ($acao->atividades as $atividade)
                        <span><b>Descrição: </b>{{ $atividade->descricao }}</span>
                        <div class="col-10">
                            <span><b>Integrantes:</b></span>
                            @foreach ($atividade->participantes as $participante)
                                <div>
                                    <ul>
                                        <span><b>Nome: </b>{{ $participante->user->name }}</span><br>
                                        <span><b>E-mail: </b>{{ $participante->user->email }}</span><br>
                                        <span><b>Carga Horária:
                                            </b>{{ $participante->carga_horaria }}</span><br>
                                        <span><b>Inicio:
                                            </b>{{ date('d/m/Y', strtotime($atividade->data_inicio)) }}</span><br>
                                        <span><b>Fim:
                                            </b>{{ date('d/m/Y', strtotime($atividade->data_fim)) }}</span><br>
                                    </ul>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
</div>
@endforeach



<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
    $(".total").html("<strong class='d-flex justify-content-sm-end mb-5' style='font-size: 20px; margin-right: 20px;'>Total de certificados: {{$total}}</strong>");
</script>
