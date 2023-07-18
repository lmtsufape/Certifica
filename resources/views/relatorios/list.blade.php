@foreach($certificados as $certificado)
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
@endforeach
<script>
    $(".total").html("<strong class='d-flex justify-content-sm-end mb-5' style='font-size: 20px; margin-right: 20px;'>Total de certificados: {{$total}}</strong>");
</script>