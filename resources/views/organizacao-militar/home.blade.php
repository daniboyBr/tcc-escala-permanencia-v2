@extends('template.main', ['title' => 'Organização Militar'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Organização Militar</h4>
            </div>
            <div class="card-body">
                @include('template.messages')
                @if (auth()->check())
                    @if (auth()->user()->isAdmin)
                        <a class="btn btn-sm float-right btn-info text-white" href="{{route('create-organizacao')}}" title="Novo Posto">
                            <i class="material-icons">add</i>
                            Nova Organização
                        </a>
                    @endif
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 70%;">Nome</th>
                                <th style="width: 10%;" class="text-center">Sigla</th>
                                @if (auth()->check())
                                    @if (auth()->user()->isAdmin)
                                        <th class="text-center">Editar</th>
                                        <th>Remover</th>
                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organizacao as $o)
                                <tr>
                                    <td><a href="{{ route('view-organizacao', ['id' => $o->id]) }}" class="text-info">{{$o->nome}}</a></td>
                                    <td class="text-center">{{$o->sigla}}</td>
                                    @if (auth()->check())
                                        @if (auth()->user()->isAdmin)
                                            <td class="text-center">
                                                <a href="{{ route('update-organizacao', ['id' => $o->id]) }}" class="text-warning" title="Editar">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </td>
                                            <td>
                                                <!-- <a href="{{ route('update-posto', ['id' => $o->id]) }}" class="btn btn-sm btn-danger">
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
                {{ $organizacao->onEachSide(5)->links('vendor.pagination.custom-simple') }}
            </div>
        </div>
    </div>
</div>
@endsection