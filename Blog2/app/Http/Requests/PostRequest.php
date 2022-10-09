<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'titulo' => 'required|max:100',
            'texto' => 'required',
            'dataFantasia' => 'required|date_format:"d/m/Y H:i"',
            'bloqueado' => 'required',
            'categoria' => 'required',
        ];
    }

    public function messages(){
      return [
        'titulo.required' => 'Preencha o campo corretamente',
        'titulo.max' => 'O campo deve conter no máximo 100 caracteres',
        'texto.required' => 'Preencha o campo corretamente',
        'dataFantasia.required' => 'Preencha o campo corretamente',
        'dataFantasia.date_format' => 'Use o formato "dia/mes/ano hora:minutos" para o campo data',
        'bloqueado.required' => 'Preencha o campo corretamente',
        'categoria.required' => 'Preencha o campo corretamente'
      ];
    }
}
