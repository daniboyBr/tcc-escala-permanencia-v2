@extends('template.main', ['title' => 'Impedimento'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Militares</h4>
            </div>
            <div class="card-body">
                @include('template.messages')

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Militar</th>
                                <th>E-mail</th>
                                @if (auth()->check())
                                    @if (auth()->user()->isAdmin)
                                        <th>Novo Impedimento</th>
                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($militares as $m)
                                <tr>
                                    <td >
                                        <a href="{{ route('view-impedimento', ['militar_id' => $m->id]) }}" class="text-info">
                                            {{$m->nomeGuerra}}
                                        </a>
                                    </td>
                                    <td>{{$m->email}}</td>
                                    @if (auth()->check())
                                        @if (auth()->user()->isAdmin)
                                        <td>
                                            <a href="{{ route('create-impedimento', ['militar_id' => $m->id]) }}" class="btn btn-sm btn-gray">
                                                <i class="material-icons">add</i>
                                                Adicionar Impedimento
                                            </a>
                                        </td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
