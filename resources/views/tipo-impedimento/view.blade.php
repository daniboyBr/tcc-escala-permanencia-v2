@extends('template.main', ['title' => 'Tipo-Impedimento'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body" id="tipo-fields">
                @include('template.messages')
                    
                @include('tipo-impedimento.form')

                @if (auth()->check())
                    @if (auth()->user()->isAdmin)
                        <a class="btn btn-sm btn-block btn-primary" href="{{route('update-tipo-impedimento',['id'=>$tipo->id])}}">
                            <i class="material-icons">edit</i>
                            EDITAR
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

<script>
    $('#tipo-fields :input').attr('disabled', true);
</script>

@endsection

