@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tokens de API') }}
                </h2>
            </div>

            <div>
                {{-- O componente Livewire é chamado aqui para gerir os tokens --}}
                @livewire('api.api-token-manager')
            </div>
        </div>
    </div>
</div>
@endsection
