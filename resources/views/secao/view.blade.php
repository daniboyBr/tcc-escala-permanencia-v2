@extends('template.main', ['title' => 'Seção'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Seção</h4>
            </div>
            <div class="card-body" id="posto-fields">
                @include('template.messages')

                @include('secao.form')

                <a class="btn btn-sm btn-primary float-right" href="{{route('update-secao',['id'=>$secao->id])}}">Editar</a>
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

