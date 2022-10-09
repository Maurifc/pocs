<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
{
    private $tamanhoNome = 100;
    private $tamanhoEmail = 100;
    private $tamanhoMensagem = 1000;

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
            'nome' => 'required|max:'.$this->tamanhoNome,
            'email' =>'required|email|max:'.$this->tamanhoEmail,
            'mensagem' => 'required|max:'.$this->tamanhoMensagem
        ];
    }

    public function messages(){
      return [
        'nome.required' => 'Preencha o campo nome',
        'nome.max' => "O tamanho máximo permitido é ".$this->tamanhoNome,
        'email.required' => 'Preencha o campo email',
        'email.email' => 'Entre com um email válido',
        'email.max' => "O tamanho máximo permitido é ".$this->tamanhoEmail,
        'mensagem.required' => 'Preencha o campo mensagem',
        'mensagem.max' => "O tamanho máximo permitido é ".$this->tamanhoMensagem
      ];
    }
}
