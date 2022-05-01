@extends('template.main', ['title'=>'Escala de Permanência - Militares'])


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Militares</h4>
            </div>
            <div class="card-body">
                @include('template.messages')

                <a class="btn btn-sm float-right btn-info text-white" href="{{route('create-militar-new')}}" title="Novo MIlitar">
                    <i class="material-icons">add</i>
                    Novo Militar
                </a>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Militar</th>
                                <th>Nome de Guerra</th>
                                <th>OM</th>
                                <th>E-mail</th>
                                <th class="text-center">Editar</th>
                                <th class="text-center">Liberar?</th>
                                <th class="text-center">È Adm?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($militar as $m)
                                <tr>
                                    <td>{{$m->nome}}</td>
                                    <td>{{$m->nomeGuerra}}</td>
                                    <td>{{$m->organizacao->nome}}</td>
                                    <td>{{$m->email}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('update-graduacao', ['id' => $m->id]) }}" class="text-warning" title="Editar">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a  href="javascript:void(0);" data-user="{{$m->id}}" class="is-actived-user">
                                            <i class="material-icons text-{{($m->flgAtivo)? 'success' : 'danger'}}">{{($m->flgAtivo)? 'check' : 'close'}}</i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" data-user="{{$m->id}}" class="is-admin-user">
                                            <i class="material-icons text-{{($m->isAdmin)? 'success' : 'danger'}}">{{($m->isAdmin)? 'check' : 'close'}}</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $militar->onEachSide(5)->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const token = document.querySelector('meta[name=csrf-token]').content;
    const isActivedUser =  document.querySelectorAll('.is-actived-user');
    const isAminUser =  document.querySelectorAll('.is-admin-user');
    
    isActivedUser.forEach((el) =>{
        el.addEventListener('click', function(event){
            let btn = event.target.closest('a');
            changeStatusUser(event.target, btn.dataset.user, "{{route('militar-liberar')}}");
        });
    });

    isAminUser.forEach((el) =>{
        el.addEventListener('click', function(event){
            let btn = event.target.closest('a');
            changeStatusUser(event.target, btn.dataset.user, "{{route('militar-perfil')}}");
        });
    });

    function changeStatusUser(btn, user, url) {
        fetch(url, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body:JSON.stringify({
                '_token': token,
                'id': user
            })
        })
        .then((response) => response.json())
        .then((data) => {
            if(!data.result){
                throw new Error(data.message);
            }

            let old_cor = (data.status)? 'danger':'success';
            let new_cor = (data.status)? 'success':'danger';
            let icon = (data.status)? 'check':'close';

            $(btn).removeClass('text-'+old_cor).addClass('text-'+new_cor).text(icon);

        }).catch(function(error) {
            console.log('There has been a problem with your fetch operation: '+error.message);
        });
    }



</script>
@endsection

