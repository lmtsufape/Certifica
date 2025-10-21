@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h2 class="mb-4">Tokens de API</h2>

            <!-- Mensagens de Sucesso -->
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Secção para Criar um Novo Token -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Gerar Novo Token de API</h5>
                    <p class="card-text text-muted">
                        Tokens de API permitem que serviços de terceiros se autentiquem na nossa aplicação em seu nome.
                    </p>

                    <form action="{{ route('tokens.store') }}" method="POST" class="mt-3">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="token_name" id="token_name" class="form-control" placeholder="Ex: Acesso do Sistema A" required aria-label="Nome do Token">
                            <button type="submit" class="btn btn-primary">
                                Gerar Token
                            </button>
                        </div>
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                    </form>
                </div>
            </div>

            <!-- Secção para Exibir o Token Recém-Criado -->
            @if (session('plainTextToken'))
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Copie o seu Novo Token</h4>
                    <p>Por segurança, este token não será exibido novamente.</p>
                    <hr>
                    <div class="input-group">
                         <input type="text" id="newToken" value="{{ session('plainTextToken') }}" class="form-control" readonly>
                         <button onclick="copyToken(this)" class="btn btn-outline-secondary">
                             Copiar
                         </button>
                    </div>
                </div>
            @endif

            <!-- Secção para Listar os Tokens Existentes -->
            <div class="card">
                 <div class="card-body">
                    <h5 class="card-title">Gerenciar Tokens</h5>
                    @if($tokens->isNotEmpty())
                        <ul class="list-group list-group-flush mt-3">
                            @foreach ($tokens as $token)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-bold">{{ $token->name }}</div>
                                        <div class="text-muted small">
                                            @if ($token->last_used_at)
                                                Último acesso em: {{ $token->last_used_at->format('d/m/Y H:i') }}
                                            @else
                                                Nunca utilizado
                                            @endif
                                        </div>
                                    </div>
                                    <form action="{{ route('tokens.destroy', $token->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem a certeza que deseja revogar este token?')">
                                            Revogar
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mt-3">Você ainda não possui tokens de API.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function copyToken(button) {
        const copyText = document.getElementById("newToken");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // Para dispositivos móveis
        document.execCommand("copy");

        button.textContent = 'Copiado!';
        setTimeout(() => { button.textContent = 'Copiar'; }, 2000);
    }
</script>
@endpush
