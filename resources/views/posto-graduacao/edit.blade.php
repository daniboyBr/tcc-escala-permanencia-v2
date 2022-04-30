@extends('template.main', ['title' => 'Posto de Servico - Editar Posto'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Editar Posto de Graduação</h4>
            </div>
            <div class="card-body">
                @include('template.messages')
                <form action="{{url()->current()}}" method="post">
                    @csrf

                    @method('PUT')

                    @include('posto-graduacao.form')

                    <button type="submit" class="btn btn-sm btn-primary float-right">Salvar</button>

                    <a href="{{route('view-graduacao', ['id'=> $posto->id])}}" class="btn btn-sm btn-danger float-right">Cancelar</a>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@endsection

