@extends('template.main', ['title' => 'Militar - Novo Militar'])

@section('css')
<style>
.avatar-pic {
width: 150px;
}

.personal-image {
  text-align: center;
}
.personal-image input[type="file"] {
  display: none;
}

.personal-figure {
  position: relative;
  width: 120px;
  height: 120px;
}

.personal-avatar {
  cursor: pointer;
  width: inherit;
  height: inherit;
  box-sizing: border-box;
  border-radius: 100%;
  border: 2px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
  transition: all ease-in-out .3s;
}
.personal-avatar:hover {
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
}


.personal-figcaption {
  cursor: pointer;
  position: absolute;
  top: 0px;
  width: inherit;
  height: inherit;
  border-radius: 100%;
  opacity: 0;
  background-color: rgba(0, 0, 0, 0);
  transition: all ease-in-out .3s;
}
.personal-figcaption:hover {
  opacity: 1;
  background-color: rgba(0, 0, 0, .5);
}
.personal-figcaption > img {
  margin-top: 32.5px;
  width: 50px;
  height: 50px;
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

                    <div class="personal-image">
                        <label class="label">
                            <input type="file" id="UploadedFile" name="imagem"/>
                            <figure class="personal-figure">
                                <img  id="preview-img" src="{{$militar->imagem? url('private/files/'.$militar->imagem) : asset('img/user.png')}}" class="personal-avatar" alt="avatar">
                                <figcaption class="personal-figcaption">
                                    <img src="{{asset('img/camera-white.png')}}">
                                </figcaption>
                            </figure>
                            <span class="Error"></span>
                        </label>
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
