@extends('template.main', ['title' => 'Posto de Servico - Novo Posto'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                @include('template.messages')

                <form action="{{url()->current()}}" method="post">
                    @csrf
                    
                    @include('posto-servico.form')

                    <button type="submit" class="btn btn-sm btn-block btn-success">SALVAR</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
