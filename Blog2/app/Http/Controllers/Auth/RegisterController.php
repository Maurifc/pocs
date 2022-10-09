<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin/usuario/listar';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'nomeCompleto' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function messages(){
      return [
        'name.required' => 'Preencha o campo Login',
        'name.string' => 'O campo deve ser um texto',
        'name.max' => 'O campo login deve conter no máximo 100 caracteres',
        'name.unique' => 'O login já existe, escolha um diferente',
        'nomeCompleto.required' => 'Preencha o campo Nome completo',
        'nomeCompleto.string' => 'O campo deve ser um texto',
        'nomeCompleto.max' => 'O campo Nome Completo deve conter no máximo 100 caracteres',
        'email.required' => 'Preencha o campo Email',
        'email.string' => 'O campo deve ser um texto',
        'email.email' => 'Entre com um email válido',
        'email.unique' => 'O E-mail já existe, escolha um diferente',
        'email.max' => 'O campo Email deve conter no máximo 100 caracteres',
        'password.required' => 'Preencha o campo Senha',
        'password.min' => 'Entre com uma senha de, no mínimo, 6 caracteres',
        'password.confirmed' => 'A senhas não são iguais'
      ];
    }

    public function register(Request $request)
    {
      try{
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        \App\Libs\Alert::success('Usuário cadastrado com sucesso');
      } catch(\Exception $e){
        \App\Libs\Alert::danger("Falha ao cadastrar o usuário");
      }
        return redirect()->route('admin.listar.usuarios');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'nomeCompleto' => $data['nomeCompleto'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
