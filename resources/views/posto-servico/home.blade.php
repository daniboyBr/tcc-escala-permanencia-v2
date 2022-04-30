@extends('template.main', ['title'=>'Escala de Permanência - Posto de Serviço'])


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Posto de Serviço</h4>
            </div>
            <div class="card-body">
                @include('template.messages')
                @if (auth()->check())
                    @if (auth()->user()->isAdmin)
                        <a class="btn btn-sm float-right btn-info text-white" href="{{route('create-posto')}}">
                            <i class="material-icons">add</i>
                            Novo Posto
                        </a>
                    @endif
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 80%;">Posto</th>
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
                                    <td><a  href="{{ route('view-posto', ['id' => $p->id]) }}" class="text-info">{{$p->nome}}</a></td>
                                    @if (auth()->check())
                                        @if (auth()->user()->isAdmin)
                                            <td class="text-center">
                                                <a href="{{ route('update-posto', ['id' => $p->id]) }}" class="text-warning">
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