<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTipoAtividade extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:5',
                Rule::unique('tipo_atividades')->ignore($this->route('tipoatividade_id')),
            ],
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
