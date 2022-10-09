<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
          'titulo' => 'required|max:50'
        ];
    }

    public function messages(){
      return [
        'categoria.required' => 'Preencha o nome da categoria',
        'categoria.max' => 'O nome da categoria pode conter no máximo 50 caracteres'
      ];
    }
}
