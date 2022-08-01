<h5>Prezado {{ $user }},</h5>

<p>
    Segudo as normas e regulamentos do exercito, viemos por meio deste, 
    notificar que houve uma mudança na escala para o qual foi escalado,
    a nova data da sua permanência <b>{{ $data }}</b>,
    no posto de serviço <b>{{ $postoServico }}</b>.
 </p>

@if($withLink)
<a href="{{ $link }}" target="_blank">Clique aqui para vizualizar a escala.</a>
@endif
<br><br>
<p>Atenciosamente,</p>

<p><b>Sistema de Escala de Permanência</b></p>