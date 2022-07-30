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
                <div class="table-responsive">
                    <table class="table ">
                        <thead class="text-center">  		
                            <tr>
                                <th>Data</th>
                                <th>Militar</th>
                                <th>OM</th>
                                <th>Seção</th>
                                <th>Posto de Graduação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($escala as $e)
                            <tr>
                                <td rowspan="2" class="text-center">{{$e->data->format('d/m/Y')}}</td>
                                <td>{{$e->militar->name}}</td>
                                <td class="text-center">{{$e->militar->organizacao->sigla}}</td>
                                <td class="text-center">{{$e->militar->secao->nome}}</td>
                                <td class="text-center">{{$e->postoServico->nome}}</td>
                            </tr>
                            <tr>
                                <td>{{$e->militarTroca->name??''}}</td>
                                <td class="text-center">{{$e->militarTroca->organizacao->sigla??''}}</td>
                                <td class="text-center">{{$e->militarTroca->secao->nome??''}}</td>
                                <td class="text-center">{{$e->postoServico->nome??''}}</td>
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
