@extends('template.main', ['title' => 'Seção - Novo Seção'])

@section('css')
    <style>
        .custom-file-input ~ .custom-file-label::after {
            content: "Buscar";
        }
    </style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Cadastro de Impedimento</h4>
            </div>
            <div class="card-body">
                @include('template.messages')

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{url()->current()}}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('impedimento.form')

                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                </form>
                <div class="clearfix"></div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection


@section('scripts')

<script>

    dataInicio = document.querySelector('#dataInicio');
    dataFinal = document.querySelector('#dataFinal');

    dataInicio.min = new Date().toISOString().split("T")[0];
    dataFinal.min = new Date().toISOString().split("T")[0];


    $('#dataInicio').on('change', function(){
        let data = $(this).val();

        if(!data){
            dataFinal.min = new Date().toISOString().split("T")[0];
            return;
        }

        dataFinal.min = data;
    })

    $(".custom-file-input").on("change", function() {
        console.log('aqui');
        var fileName = $(this).val().split("\\").pop();
        fileName = (fileName)? encurtarNomeArquivo(fileName) : 'Selecionar';
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    function encurtarNomeArquivo(fileName){
        return (fileName.length > 25 )? fileName.substr(0,25)+'...' : fileName;
    }
</script>

@endsection
