@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nomeGuerra" class="col-md-4 col-form-label text-md-end">{{ __('Nome de Guerra') }}</label>

                            <div class="col-md-6">
                                <input id="nomeGuerra" type="text" class="form-control @error('nomeGuerra') is-invalid @enderror" name="nomeGuerra" value="{{ old('nomeGuerra') }}" required autocomplete="nomeGuerra">

                                @error('nomeGuerra')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ramal" class="col-md-4 col-form-label text-md-end">{{ __('Ramal') }}</label>

                            <div class="col-md-6">
                                <input id="ramal" type="text" class="form-control @error('ramal') is-invalid @enderror" name="ramal" value="{{ old('ramal') }}" required autocomplete="ramal">

                                @error('ramal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telefoneResidencial" class="col-md-4 col-form-label text-md-end">{{ __('Telefone Residencial') }}</label>

                            <div class="col-md-6">
                                <input id="telefoneResidencial" type="text" class="form-control @error('telefoneResidencial') is-invalid @enderror" name="telefoneResidencial" value="{{ old('telefoneResidencial') }}" required autocomplete="telefoneResidencial">

                                @error('telefoneResidencial')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telefoneCelular" class="col-md-4 col-form-label text-md-end">{{ __('Telefone Celular') }}</label>

                            <div class="col-md-6">
                                <input id="telefoneCelular" type="text" class="form-control @error('telefoneCelular') is-invalid @enderror" name="telefoneCelular" value="{{ old('telefoneCelular') }}" required autocomplete="telefoneCelular">

                                @error('telefoneCelular')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="organizacaoMilitar_id" class="col-md-4 col-form-label text-md-end">{{ __('Organizaçao Militar') }}</label>

                            <div class="col-md-6">
                                <select id="organizacaoMilitar_id" class="form-select @error('organizacaoMilitar_id') is-invalid @enderror" aria-label="Organização Militar" name="organizacaoMilitar_id" value="{{ old('organizacaoMilitar_id') }}" required>
                                    <option selected>-- Selecione uma opção --</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>

                                @error('organizacaoMilitar_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="secao_id" class="col-md-4 col-form-label text-md-end">{{ __('Seção') }}</label>

                            <div class="col-md-6">
                                <select id="secao_id" class="form-select @error('secao_id') is-invalid @enderror" aria-label="Seção" name="secao_id" value="{{ old('secao_id') }}" required>
                                    <option selected>-- Selecione uma opção --</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>

                                @error('secao_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="postoGraduacao_id" class="col-md-4 col-form-label text-md-end">{{ __('Posto de Graduação') }}</label>

                            <div class="col-md-6">
                                <select id="postoGraduacao_id" class="form-select @error('postoGraduacao_id') is-invalid @enderror" aria-label="Posto de Graduação" name="postoGraduacao_id" value="{{ old('postoGraduacao_id') }}" required>
                                    <option selected>-- Selecione uma opção --</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>

                                @error('postoGraduacao_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirme a Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
