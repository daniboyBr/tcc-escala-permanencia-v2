@extends('template.main', ['title' => 'Organização Militar - Nova Organização'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Cadastro de Organização Militar</h4>
            </div>
            <div class="card-body">
                @include('template.messages')

                <form action="{{url()->current()}}" method="post">
                    @csrf

                    @include('organizacao-militar.form')

                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
</div>
@endsection
