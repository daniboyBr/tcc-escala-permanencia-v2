<div class="form-group">
    <label for="bmd-label-floating">Organização Militar:</label>
    <select required name="organizacaoMilitar_id" id="organizacao-militar" class="custom-select">
        <option value="">-- Selecione a organização --</option>
        @foreach($organizacao as $o)
            <option value="{{$o->id}}"  {{$secao->organizacaoMilitar_id == $o->id? 'selected':''}}>{{$o->nome}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="form-label">Seção:</label>
    <input required type="text" class="form-control form-control-sm" name="nome" value="{{$secao->nome}}">
</div>
