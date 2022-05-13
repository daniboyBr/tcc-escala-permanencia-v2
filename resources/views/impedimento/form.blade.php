<div class="form-group">
    <label for="form-label">Militar:</label>
    <input type="hidden" name="militar_id" value="{{$impedimento->militar_id}}">
    <input disabled type="text" class="form-control form-control-sm" value="{{$militar->nome}}">
</div>

<div class="form-group">
    <label for="form-label">Data Incío:</label>
    <input required type="date" class="form-control form-control-sm" id="dataInicio" name="dataInicio" value="{{$impedimento->dataInicio}}">
</div>

<div class="form-group">
    <label for="form-label">Data Final:</label>
    <input required type="date" class="form-control form-control-sm" id="dataFinal" name="dataFinal" value="{{$impedimento->dataFinal}}">
</div>

<div class="form-group">
    <label for="form-label">Arquivo:</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="customFile" name="arquivo" accept=".pdf">
        <label class="custom-file-label" for="customFile">Selecionar</label>
    </div>
</div>

