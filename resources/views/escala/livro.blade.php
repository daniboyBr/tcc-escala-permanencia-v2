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
                <form action="{{url()->current()}}" method="POST">
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
                        <input type="text" class="form-control" value="{{$militar->name}}" max="20" disabled>
                    </div>
                    <div class="form-group">
                        <label for="bmd-label-floating">Relato da Permanência:</label>
                        <textarea name="livroPermanencia" cols="30" rows="10" class="form-control" required>{{$escala->livroPermanencia}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection