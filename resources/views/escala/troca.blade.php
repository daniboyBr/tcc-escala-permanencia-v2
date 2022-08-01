@extends('template.main', ['title' => 'Troca de Permanência'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Escala</h4>
            </div>
            <div class="card-body">
                @include('template.messages')
                <form action="{{url()->current()}}" method="GET" class="form-inline">
                    <div class="form-group ">
                        <label for="form-label">Buscar Militar para Troca: </label>
                        <input type="text" class="form-control form-control-sm ml-2 mr-3" name="identidade"  id="input-identidade"/>
                    </div>
                    <button class="btn btn-sm"  type="submit">Buscar</button>
                </form>
                <br>
                <form action="{{route('confirm-switch-militar', ['escala' => $escala->uuidEscala])}}" method="POST">
                    @csrf    
                    <div class="form-group">
                        <label for="bmd-label-floating">Data do Serviço:</label>
                        <input type="date" class="form-control" name="ramal" value="{{$escala->data->format('Y-m-d')}}" max="20" disabled>
                    </div>
                    <div class="form-group">
                        <label for="bmd-label-floating">Posto de Serviço:</label>
                        <input type="text" class="form-control" value="{{$escala->postoServico->nome}}" max="20" disabled>
                    </div>
                    <div class="form-group">
                        <label for="bmd-label-floating">Militar da Permanência:</label>
                        <input type="text" class="form-control" value="{{$escala->militar->name}}" max="20" disabled>
                    </div>
                    <div class="form-group">
                        <label for="bmd-label-floating">Militar para troca:</label>
                        <input type="hidden" name="militarTroca_id" value="{{$militarTroca->id}}">
                        <input type="text" class="form-control  @error('militarTroca_id') is-invalid @enderror" value="{{$militarTroca->name}}" disabled>
                        @error('militarTroca_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="bmd-label-floating">Justificativa da Troca:</label>
                        <textarea name="observacaoTroca" cols="30" rows="10" class="form-control">{{$escala->observacaoTroca}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Efetuar Troca</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection