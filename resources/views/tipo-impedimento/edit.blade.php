@extends('template.main', ['title' => 'Tipo de Impedimento'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                @include('template.messages')

                <form action="{{url()->current()}}" method="post">
                    @csrf

                    @method('PUT')
                    
                    @include('tipo-impedimento.form')

                    <button type="submit" class="btn btn-sm btn-block btn-success">SALVAR</button>

                    <a href="{{route('view-tipo-impediemnto', ['id'=> $tipo->id])}}" class="btn btn-sm btn-danger btn-block">CANCELAR</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
