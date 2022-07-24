@extends('template.main', ['title' => 'Posto de Servico'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body" id="posto-fields">
                @include('template.messages')
                    
                @include('posto-servico.form')

                @if (auth()->check())
                    @if (auth()->user()->isAdmin)
                        <a class="btn btn-sm btn-block btn-primary" href="{{route('update-posto',['id'=>$posto->id])}}">
                            <i class="material-icons">edit</i>
                            EDITAR
                        </a>
                    @endif
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Graduação Cadastradas</th>
                            </tr>
                        <thead>
                        <tbody>
                            @foreach ($posto->postoGraduacao as $p)
                            <tr>
                                <td>{{$p->nome}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

<script>
    $('#posto-fields :input').not('.close').attr('disabled', true);
</script>

@endsection

