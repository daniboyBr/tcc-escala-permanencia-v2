<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Militar;
use App\Models\OrganizacaoMilitar;
use App\Models\PostoGraduacao;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

	public function showRegistrationForm()
	{
		return view('auth.register', [
			'organizacao' => OrganizacaoMilitar::where('flgAtivo', 1)->get(['id', 'nome']),
			'posto' => PostoGraduacao::where('flgAtivo', 1)->get(['id', 'nome'])
		]);
	}

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
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
			'name' => ['required', 'string', 'max:255'],
			'nomeGuerra' => ['required', 'string', 'max:60'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:militar'],
			'organizacaoMilitar_id' => ['required', 'exists:organizacaoMilitar,id'],
			'secao_id' => ['required', 'exists:secao,id'],
			'postoGraduacao_id' => ['required', 'exists:postoGraduacao,id'],
			'ramal' => ['max:10'],
			'telefoneResidencial' => ['numeric', 'digits_between:0,10'],
			'telefoneCelular' => ['numeric', 'digits_between:0,11'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\Models\User
	 */
	protected function create(array $data)
	{
		return Militar::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'nomeGuerra' => $data['nomeGuerra'],
			'organizacaoMilitar_id' => $data['organizacaoMilitar_id'],
			'secao_id' => $data['secao_id'],
			'postoGraduacao_id' => $data['postoGraduacao_id'],
			'ramal' => $data['ramal'],
			'telefoneResidencial' => $data['telefoneResidencial'],
			'telefoneCelular' => $data['telefoneCelular'],
			'password' => Hash::make($data['password']),
		]);
	}
}
