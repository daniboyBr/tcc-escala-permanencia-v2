@extends('template.main', ['title' => 'Indicar Posto de Graduação'])

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Indicar Posto de Graduação</h4>
            </div>
            <div class="card-body">
                @include('template.messages')

                <form action="{{url()->current()}}" method="post">
                    @csrf

                    @include('indicar-graduacao.form')

                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#postoServico-id').on('change', function() {
        let select = document.querySelector('#postoServico-id')
        var option = select.options[select.selectedIndex].value
        
        if(!option){ return }

        fetch(`/indicar-graduacao/servico/${option}`)
        .then((data) =>{ return data.json() })
        .then((data) => {
            console.log(data);
            $('#postoGraduaco-id option').each(function() {
                if ($(this).val() == '' ) {
                    return;
                }
                $(this).remove();
            });

            if(data){
                data.graduacoes.forEach(element => {
                    let newOption = $('<option>').val(element.id).text(element.nome).appendTo('#postoGraduaco-id');
                    var secaoSected = $('#postoGraduaco-id ').val();
                    if(secaoSected && element.id == secaoSected){
                        $(newOption).attr('selected', true);
                    }
                });
            }
        });
    }).change();

</script>
@endsection

