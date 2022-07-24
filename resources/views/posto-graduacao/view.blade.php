@extends('template.main', ['title' => 'Posto de Graduação'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Posto de Graduação</h4>
            </div>
            <div class="card-body" id="posto-fields">
                @include('template.messages')

                @include('posto-graduacao.form')

                @if (auth()->check())
                    @if (auth()->user()->isAdmin)
                    <a class="btn btn-sm btn-primary float-right" href="{{route('update-graduacao',['id'=>$posto->id])}}" title="Editar">
                        <i class="material-icons">edit</i>
                        Editar
                    </a>
                    @endif
                @endif
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

<script>
    $('#posto-fields :input').not('.close').attr('disabled', true);
</script>

@endsection

