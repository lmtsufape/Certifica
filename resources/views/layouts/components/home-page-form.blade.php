<form method="POST" action="{{ route('login') }}" class="home-page-form-grid p-5 text-center">
    @csrf
  <div class="form-group pb-5 home-page-form-title">
    <label for="entreNaSuaConta">Entre na sua conta</label>
  </div>

  <div class="form-group pb-3">
    <input
    id="email"
    type="email"
    name="email"
    value="{{ old('email') }}"
    required
    autocomplete="email"
    autofocus
    class="
     form-control
     @error('email') is-invalid @enderror
     input-icon-arroba"
    aria-describedby="emailHelp"
    placeholder="Insira seu e-mail"
    >
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

  </div>

  <div class="form-group pb-3">
    <input
    id="password"
    type="password"
    class="form-control input-icon-lock @error('password') is-invalid @enderror"
    name="password"
    required autocomplete="current-password"
    placeholder="Digite sua senha"
    >
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  <div class="form-group d-flex justify-content-end pb-4">
    @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="text-grey">Esqueceu sua senha?</a>
    @endif

  </div>

  <div class="form-group pb-5">
    <button type="submit" class="btn home-page-form-submet-button text-white">Entrar</button>
  </div>

  <div class="form-group">
    <label for="naoPossuiConta_criarConta">Não possui conta? <a href="" class="tdl-nl text-yellow">Criar conta</a></label>
  </div>


</form>
