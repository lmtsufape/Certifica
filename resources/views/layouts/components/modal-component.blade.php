<div class="modal fade" id="modalComponent" tabindex="-1" aria-labelledby="modalComponentLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalComponentLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="button cancel btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <!-- Adicione um ID ao botão "Cadastrar" -->
                <button id="submitFormButton" class="button submit btn-success" type="button">Cadastrar</button>
            </div>
        </div>
    </div>
</div>