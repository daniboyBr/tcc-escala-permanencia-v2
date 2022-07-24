<div class="form-group">
    <label for="bmd-label-floating">Posto de Serviço:</label>
    <select required name="postoServico_id" id="postoServico-id" class="select-posto custom-select @error('postoServico_id') is-invalid @enderror">
        <option value="">-- Posto de Serviço --</option>
        @foreach($servicos as $s)
            <option value="{{$s->id}}" {{$pgPostoServico->postoServico_id == $s->id? 'selected':''}}>{{$s->nome}}</option>
        @endforeach
    </select>
    @error('postoServico_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="bmd-label-floating">Posto de Graduação:</label>
    <select required name="postoGraduacao_id" id="postoGraduaco-id" class="select-posto custom-select @error('postoGraduacao_id') is-invalid @enderror">
        <option value="">-- Posto de Graduação --</option>
    </select>
    @error('postoGraduacao_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
