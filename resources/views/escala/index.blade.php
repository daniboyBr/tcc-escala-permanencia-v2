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
                            <tr>
                                <td rowspan="2" class="text-center">01/06/2019</td>
                                <td>Teste teste teste</td>
                                <td class="text-center">teste</td>
                                <td class="text-center">teste</td>
                                <td class="text-center">teste</td>
                            </tr>
                            <tr>
                                <td>teste</td>
                                <td class="text-center">teste</td>
                                <td class="text-center">teste</td>
                                <td class="text-center">teste</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
