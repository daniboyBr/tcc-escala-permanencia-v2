<div class="form-group">
    <label for="bmd-label-floating">Nome:</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$militar->name}}"> 
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="bmd-label-floating">Nome de Guerra:</label>
    <input type="text" class="form-control" name="nomeGuerra" value="{{$militar->nomeGuerra}}"> 
</div>

<div class="form-group">
    <label for="bmd-label-floating">E-mail:</label>
    @if(request()->route()->named('update-militar'))
        <input type="email" class="form-control" disabled value="{{$militar->email}}"> 
    @else   
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$militar->email}}"> 
    @endif
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="bmd-label-floating">Senha:</label>
    @if(request()->route()->named('update-militar'))
        <input type="password" class="form-control" name="password" value="{{$militar->password}}"> 
    @else   
        <input type="password" class="form-control @error('password') is-invalid @enderror" required name="password" value="{{$militar->password}}"> 
    @endif
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="bmd-label-floating">Confirme a Senha:</label>
    @if(request()->route()->named('update-militar'))
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
    @else   
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    @endif
</div>
<div class="form-group">
    <label for="bmd-label-floating">Identidade:</label>
    <input type="text" class="form-control" name="ramal" value="{{$militar->identidade}}" max="20"> 
</div>
<div class="form-group">
    <label for="bmd-label-floating">Ramal:</label>
    <input type="text" class="form-control" name="ramal" value="{{$militar->ramal}}"> 
</div>
<div class="form-group">
    <label for="bmd-label-floating">Telefone Residêncial:</label>
    <input type="text" class="form-control" name="telefoneResidencial" value="{{$militar->telefoneResidencial}}"> 
</div>
<div class="form-group">
    <label for="bmd-label-floating">Telefone Celular:</label>
    <input type="text" class="form-control" name="telefoneCelular" value="{{$militar->telefoneCelular}}"> 
</div>
<div class="form-group">
    <label for="bmd-label-floating">Organização Militar:</label>
    <select name="organizacaoMilitar_id" id="organizacao-militar" class="custom-select">
        <option value="">-- Selecione a organização --</option>
        @foreach($organizacao as $o)
            <option value="{{$o->id}}"  {{$militar->organizacaoMilitar_id == $o->id? 'selected':''}}>{{$o->nome}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="bmd-label-floating">Seção:</label>
    <input type="hidden" id="secao-id" value="{{$militar->secao_id}}">
    <select name="secao_id" id="secao" class="custom-select">
        <option value="">-- Selecione a seção --</option>
    </select>
</div>
<div class="form-group">
    <label for="bmd-label-floating">Posto Gradução:</label>
    <select name="postoGraduacao_id" id="posto-graduacao" class="custom-select">
        <option value="">-- Selecione o posto --</option>
        @foreach($graduacao as $g)
            <option value="{{$g->id}}"  {{$militar->postoGraduacao_id == $g->id? 'selected':''}}>{{$g->nome}}</option>
        @endforeach
    </select>
</div>