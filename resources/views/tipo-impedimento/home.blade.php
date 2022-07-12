@extends('template.main', ['title'=>'Tipo de Impedimento'])


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Tipo de Impedimento</h4>
            </div>
            <div class="card-body">
                @include('template.messages')
                @if (auth()->check())
                    @if (auth()->user()->isAdmin)
                        <a class="btn btn-sm float-right btn-info text-white" href="{{route('create-tipo-impedimento')}}">
                            <i class="material-icons">add</i>
                            Novo Tipo de Impedimento
                        </a>
                    @endif
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 80%;">Tipos de Impedimento</th>
                                @if (auth()->check())
                                    @if (auth()->user()->isAdmin)
                                        <th class="text-center">Editar</th>
                                        <th>Remover</th>
                                    @endif
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipos as $t)
                                <tr>
                                    <td><a  href="{{ route('view-tipo-impedimento', ['id' => $t->id]) }}" class="text-info">{{$t->nome}}</a></td>
                                    @if (auth()->check())
                                        @if (auth()->user()->isAdmin)
                                            <td class="text-center">
                                                <a href="{{ route('update-tipo-impedimento', ['id' => $t->id]) }}" class="text-warning">
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
                {{ $tipos->onEachSide(5)->links('vendor.pagination.custom-simple') }}
            </div>
        </div>
    </div>
</div>
@endsection