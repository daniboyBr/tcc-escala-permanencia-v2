@extends('template.main', ['title' => 'Escala de Permanência'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Escala</h4>
            </div>
            <div class="card-body">
                @include('template.messages')
                <form action="{{url()->current()}}" method="GET" class="form-inline">
                    <div class="form-group ">
                        <label for="form-label">Data:</label>
                        <input type="date" class="form-control form-control-sm ml-2 mr-3" name="data">
                    </div>
                    <button class="btn btn-sm">Buscar</button>
                </form>
                <div class="table-responsive">
                    <table class="table ">
                        <thead class="text-center">  		
                            <tr>
                                <th>Data</th>
                                <th>Posto de Serviço</th>
                                <th>Militar</th>
                                <th>OM</th>
                                <th>Seção</th>
                                <th>Posto de Graduação</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($escala as $e)
                            <tr>
                                <td rowspan="2" class="text-center">{{$e->data->format('d/m/Y')}}</td>
                                <td rowspan="2" class="text-center">{{$e->postoServico->nome}}</td>
                                <td>{{$e->militar->name}}</td>
                                <td class="text-center">{{$e->militar->organizacao->sigla}}</td>
                                <td class="text-center">{{$e->militar->secao->nome}}</td>
                                <td class="text-center">{{$e->militar->graduacao->nome}}</td>
                                <td rowspan="2" class="text-center">
                                    @if($e->can_switch)
                                        <a href="{{route('switch-militar', ['escala'=> $e->uuidEscala])}}" class="btn btn-sm trocar-militar">Troucar</a>
                                    @endif
                                    @if($e->enable_book_record)
                                        <a href="{{route('escala-register', ['escala'=> $e->uuidEscala])}}" class="btn btn-sm trocar-militar">Livro</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class=" " style="background-color: #c9def2;">{{$e->militarTroca->name??''}}</td>
                                <td class=" text-center " style="background-color: #c9def2;">{{$e->militarTroca->organizacao->sigla??''}}</td>
                                <td class=" text-center " style="background-color: #c9def2;">{{$e->militarTroca->secao->nome??''}}</td>
                                <td class=" text-center " style="background-color: #c9def2;">{{$e->militarTroca->graduacao->nome??''}}</td>
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