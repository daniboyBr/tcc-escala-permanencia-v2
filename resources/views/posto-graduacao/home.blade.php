@extends('template.main', ['title'=>'Escala de Permanência - Posto de Graduação'])


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Posto de Graduação</h4>
            </div>
            <div class="card-body">
                @include('template.messages')
                @if (auth()->check())
                    @if (auth()->user()->isAdmin)
                        <a class="btn btn-sm float-right btn-info text-white" href="{{route('create-graduacao')}}" title="Novo Posto">
                            <i class="material-icons">add</i>
                            Novo Posto
                        </a>
                    @endif
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 70%;">Posto</th>
                                <th style="width: 10%;" class="text-center">Nível</th>
                                @if (auth()->check())
                                    @if (auth()->user()->isAdmin)
                                        <th class="text-center">Editar</th>
                                        <th>Remover</th>
                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postos as $p)
                                <tr>
                                    <td><a href="{{ route('view-graduacao', ['id' => $p->id]) }}" class="text-info">{{$p->nome}}</a></td>
                                    <td class="text-center">{{$p->nivel}}</td>
                                    @if (auth()->check())
                                        @if (auth()->user()->isAdmin)
                                            <td class="text-center">
                                                <a href="{{ route('update-graduacao', ['id' => $p->id]) }}" class="text-warning" title="Editar">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </td>
                                            <td>

                                            </td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $postos->onEachSide(5)->links('vendor.pagination.custom-simple') }}
            </div>
        </div>
    </div>
</div>
@endsection