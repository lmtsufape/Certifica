<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoAtividade extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:tipo_atividades|min:5',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Nome é um campo obrigatório',
            'name.unique' => 'Nome da atividade indisponivel',
            'name.min' => 'Nome deve ter no mínimo 5 caracteres'
        ];
    }
}
