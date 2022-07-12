@extends('template.main', ['title' => 'Tipo de Impedimento'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                @include('template.messages')

                <form action="{{url()->current()}}" method="post">
                    @csrf
                    
                    @include('tipo-impedimento.form')

                    <button type="submit" class="btn btn-sm btn-block btn-success">SALVAR</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
