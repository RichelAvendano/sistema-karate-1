<div>
    <h1>{{$title}}</h1>

    <h3>{{ $count }}</h3>
 
    <button wire:click="increment()" class="btn btn-purple">+</button>
 
    <button wire:click="decrement" class="btn btn-purple">-</button>

    <h1>Usuario: {{$name}}</h1>
    <h1>Correo: {{$email}}</h1>
    <h1>Rol: {{$role}}</h1>
    <input wire:model.live='name' type="text" class="form-control">
    <button class="btn btn-success" wire:click='save'>Guardar</button>
</div>