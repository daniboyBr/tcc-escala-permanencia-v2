@extends('template.main', ['title' => 'Organização Militar'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Organização Militar</h4>
            </div>
            <div class="card-body" id="posto-fields">
                @include('template.messages')

                @include('organizacao-militar.form')

                @if (auth()->check())
                    @if (auth()->user()->isAdmin)
                        <a class="btn btn-sm btn-primary float-right" href="{{route('update-organizacao',['id'=>$organizacao->id])}}">
                            <i class="material-icons">edit</i> Editar
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
    $('#posto-fields :input').attr('disabled', true);
</script>

@endsection

