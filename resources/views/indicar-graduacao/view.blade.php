@extends('template.main', ['title' => 'Indicar Posto de Graduação'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Indicar Posto de Graduação</h4>
            </div>
            <div class="card-body" id="posto-fields">
                @include('template.messages')

                <div class="form-group">
                    <label for="bmd-label-floating">Posto de Serviço:</label>
                    <select required name="postoServico_id" id="postoServico-id" class="select-posto custom-select" disabled>
                        <option value="{{$posto->postoGraduacao_id}}" selected>{{$posto->postoServico->nome}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bmd-label-floating">Posto de Graduação:</label>
                    <select required name="postoGraduacao_id" id="postoGraduaco-id" class="select-posto custom-select" disabled>
                        <option value="{{$posto->postoServico_id}}" selected>{{$posto->postoGraducao->nome}}</option>
                    </select>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

<script>
    $('.select-posto :select').attr('disabled', true);
</script>

@endsection

