<?php
$task = json_encode($user->request->original->descripition);
?>

@component('mail::message')

<h1>Houve uma movimentação na API</h1>
<p>{{$user->name}} este foi o email que você cadastrou {{$user->email}}</p>


@if ( $task == "null" )
<p>Movimentação no Status de Tarefas: {{$user->request}}</p>
@else
<p>Movimentação de Tarefas: {{$user->request}}</p>
@endif



@component('mail::button', ['url'=> 'https://api.whatsapp.com/send?phone=5511950903204&text=Parab%C3%A9ns%20Pedro%20voc%C3%AA%20%C3%A9%20o%20perfil%20de%20DEV.%20que%20busc%C3%A1vamos!'])
verificar!
@endcomponent
@endcomponent