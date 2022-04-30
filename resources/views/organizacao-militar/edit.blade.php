@extends('template.main', ['title' => 'Organização Militar - Editar Organização'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Editar Organização Militar</h4>
            </div>
            <div class="card-body">
                @include('template.messages')
                <form action="{{url()->current()}}" method="post">
                    @csrf

                    @method('PUT')

                    @include('organizacao-militar.form')

                    <button type="submit" class="btn btn-sm btn-primary float-right">Salvar</button>

                    <a href="{{route('view-organizacao', ['id'=> $organizacao->id])}}" class="btn btn-sm btn-danger float-right">Cancelar</a>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@endsection

