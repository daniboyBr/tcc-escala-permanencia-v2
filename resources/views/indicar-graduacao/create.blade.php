@extends('template.main', ['title' => 'Indicar Posto de Graduação'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Indicar Posto de Graduação</h4>
            </div>
            <div class="card-body">
                @include('template.messages')

                <form action="{{url()->current()}}" method="post">
                    @csrf

                    @include('indicar-graduacao.form')

                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
</div>
@endsection
