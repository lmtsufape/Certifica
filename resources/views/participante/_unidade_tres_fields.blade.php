@php($infoExterna = $infoExterna ?? null)

<fieldset class="dados-adicionais">
    <legend>Informações adicionais</legend>
    <p class="dados-adicionais-description">
        Dados específicos do plano e da orientação deste participante.
    </p>

    <div class="row g-3">
        <div class="col-lg-7">
            <label class="form-label" for="titulo_plano">Título do Plano</label>
            <input class="form-control" id="titulo_plano" type="text" name="titulo_plano"
                value="{{ old('titulo_plano', optional($infoExterna)->titulo_plano) }}" required>
        </div>
        <div class="col-lg-5">
            <label class="form-label" for="tipo_natureza_participante">Tipo da Natureza</label>
            <input class="form-control" id="tipo_natureza_participante" type="text"
                name="tipo_natureza_participante"
                value="{{ old('tipo_natureza_participante', optional($infoExterna)->tipo_natureza_participante) }}"
                placeholder="Informe o tipo da natureza" maxlength="255" required>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-lg-4">
            <label class="form-label" for="orientador">Nome do Orientador</label>
            <input class="form-control" id="orientador" type="text" name="orientador"
                value="{{ old('orientador', optional($infoExterna)->orientador) }}" required>
        </div>
        <div class="col-lg-3">
            <label class="form-label" for="orientador_cpf">CPF do Orientador</label>
            <input class="form-control" id="orientador_cpf" type="text" name="orientador_cpf"
                value="{{ old('orientador_cpf', optional($infoExterna)->orientador_cpf) }}"
                placeholder="000.000.000-00" inputmode="numeric" maxlength="14"
                pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required>
        </div>
        <div class="col-lg-5">
            <label class="form-label" for="orientador_email">E-mail do Orientador</label>
            <input class="form-control" id="orientador_email" type="email" name="orientador_email"
                value="{{ old('orientador_email', optional($infoExterna)->orientador_email) }}" required>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-md-6">
            <label class="form-label" for="data_inicio_participante">Data de Início</label>
            <input class="form-control" id="data_inicio_participante" type="date" name="data_inicio_participante"
                value="{{ old('data_inicio_participante', $infoExterna && $infoExterna->data_inicio ? $infoExterna->data_inicio->format('Y-m-d') : '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="data_fim_participante">Data de Término</label>
            <input class="form-control" id="data_fim_participante" type="date" name="data_fim_participante"
                value="{{ old('data_fim_participante', $infoExterna && $infoExterna->data_fim ? $infoExterna->data_fim->format('Y-m-d') : '') }}" required>
        </div>
    </div>
</fieldset>

@push('scripts')
    <script>
        $(function() {
            $('#orientador_cpf').mask('000.000.000-00');
        });
    </script>
@endpush
