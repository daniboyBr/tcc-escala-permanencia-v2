@extends('template.main', ['title' => 'Militar - Novo Militar'])

@section('css')
<style>
    .preview
{
    padding: 10px;
    position: relative;
}

.preview i
{
    color: white;
    font-size: 35px;
    transform: translate(50px,130px);
}

.preview-img
{
    border-radius: 100%;
    box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.7);
}

.browse-button
{
    width: 200px;
    height: 200px;
    border-radius: 100%;
    position: absolute; /* Tweak the position property if the element seems to be unfit */
    top: 10px;
    left: 132px;
    background: linear-gradient(180deg, transparent, black);
    opacity: 0;
    transition: 0.3s ease;
}

.browse-button:hover
{
    opacity: 1;
}

.browse-input
{
    width: 200px;
    height: 200px;
    border-radius: 100%;
    transform: translate(-1px,-26px);
    opacity: 0;
}

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Cadastro de Militar</h4>     
            </div>
            <div class="card-body">
                @include('template.messages')

                <form action="{{url()->current()}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="preview text-center">
                        <img id="preview-img" class="preview-img" src="{{$militar->imagem? asset('storage/'.$militar->imagem) : asset('img/user.png')}}" alt="Preview Image" width="200" height="200"/>
                        <div class="browse-button">
                            <i class="material-icons">edit</i>
                            <input class="browse-input" type="file" name="imagem" id="UploadedFile"/>
                        </div>
                        <span class="Error"></span>
                    </div>
                                        
                    @include('militar.form')

                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                    <button type="button" class="btn btn-primary float-right">Limpar</button>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#UploadedFile').on('change',function(event){
        const files = event.target.files;
        if (files.length != 0) {
            $('#preview-img').attr('src',URL.createObjectURL(event.target.files[0]));
        }
    });

    $('#organizacao-militar').on('change', function() {
        let select = document.querySelector('#organizacao-militar')
        var option = select.options[select.selectedIndex].value
        
        if(!option){ return }

        fetch(`/organizacao-militar/${option}/secao`)
        .then((data) =>{ return data.json() })
        .then((data) => {
            $('#secao option').each(function() {
                if ($(this).val() == '' ) {
                    return;
                }
                $(this).remove();
            });

            if(data){
                data.secao.forEach(element => {
                    let newOption = $('<option>').val(element.id).text(element.nome).appendTo('#secao');
                    var secaoSected = $('#secao-id').val();
                    if(secaoSected && element.id == secaoSected){
                        $(newOption).attr('selected', true);
                    }
                });
            }
        });
    }).change();

</script>
@endsection
