@extends('template.main', ['title' => 'Seção'])


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Seção</h4>
            </div>
            <div class="card-body">
                @include('template.messages')
                @if (auth()->check())
                    @if (auth()->user()->isAdmin)
                        <a class="btn btn-sm float-right btn-info text-white" href="{{route('create-secao')}}" title="Novo Posto">
                            <i class="material-icons">add</i>
                            Nova Seção
                        </a>
                    @endif
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30%;">Seção</th>
                                <th style="width: 30%;">Orgaização Militar</th>
                                @if (auth()->check())
                                    @if (auth()->user()->isAdmin)
                                        <th class="text-center">Editar</th>
                                        <th>Remover</th>
                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($secao as $s)
                                <tr>
                                    <td>{{$s->nome}}</td>
                                    <td>{{$s->organizacao->nome}}</td>
                                    @if (auth()->check())
                                        @if (auth()->user()->isAdmin)
                                            <td class="text-center">
                                                <a href="{{ route('update-secao', ['id' => $s->id]) }}" class="text-warning" title="Editar">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </td>
                                            <td>
                                                <!-- <a href="{{ route('update-secao', ['id' => $s->id]) }}" class="btn btn-sm btn-danger">
                                                    <i class="material-icons">trash</i>
                                                    Adicionar Impedimento
                                                </a> -->
                                            </td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $secao->links('vendor.pagination.custom-simple') }}
            </div>
        </div>
    </div>
</div>
@endsection