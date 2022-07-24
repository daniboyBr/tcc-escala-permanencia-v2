@extends('template.main', ['title' => 'Impedimento'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Impedimentos</h4>
            </div>
            <div class="card-body">
                @include('template.messages')
                <p>{{$militar->name}}</p>
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>Tipo Impedimento</th>
                                <th>Início do Impedimento</th>
                                <th>Fim do Impedimento</th>
                                <th>Documento Anexado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($militar->impedimentos as $i)
                                <tr>
                                    <td>{{$i->tipoImpedimento->nome}}</td>
                                    <td>{{$i->dataInicio->format('d/m/Y')}}</td>
                                    <td>{{$i->dataFinal->format('d/m/Y')}}</td>
                                    <td>
                                        <a target="blank" href='{{ url("private/files/{$i->arquivo}")}}' >
                                            <i class="material-icons">insert_drive_file</i>
                                        </a>
                                    </td>
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

