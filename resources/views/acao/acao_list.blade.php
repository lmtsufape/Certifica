@foreach($acoes as $acao)
    <div class="row linha-table d-flex align-items-center justify-content-start">
        <div class="col-3 titulo-span text-center"><span class="spacing-col">{{$acao->titulo}}</span></div>
        <div class="col-2 text-center"><span>{{date( 'd/m/Y' , strtotime($acao->data_inicio)).' - '.date( 'd/m/Y' , strtotime($acao->data_fim))}}</span></div>
        <div class="col-2 text-center titulo-span"><span>{{$acao->status}}</span></div>
        <div class="col-2 text-center"><span>{{$acao->tipo_natureza->natureza->descricao}}</span></div>
        <div class="col-2 text-center titulo-span"><span><a href="#"></a>Ver atividades</span></div>
        <div class="col-1 text-center titulo-span"><span><a href="#"></a>Icones</span></div>
    </div>
@endforeach