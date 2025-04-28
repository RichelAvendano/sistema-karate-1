<div>
    <div class="panel-body">
					
        <!-- Inline Form  -->
        <!--===================================================-->
        <form class="form-inline" wire:submit='save'>
            <div class="form-group">
                <label for="input" class="sr-only">Email address</label>
                <input wire:model='pais' type="text" id="input" class="form-control" autocomplete="off" wire:keydown='increment(1)'>
            </div>
            <button class="btn btn-pink" type="submit">Enviar</button>
            <button class="btn btn-danger" type='button' wire:click='$set("numIncrement", 0)'>Resetear</button>
            <button class="btn btn-success" type='button' wire:click='$toggle("open")'>Mostrar / Ocultar</button>
            
        </form>
        <span>{{$numIncrement}}</span>
        @if ($errorMessage)
            <div 
                wire:key='error-(1)' 
                class="alert alert-danger animated bounceIn" 
                style="margin-top: 10px; margin-bottom: 0px">
                {{ $errorMessage }}
            </div>
        @endif



        <!--===================================================-->
        <!-- End Inline Form  -->

    </div>
    <ul class="list-group">
        @if($open)
            @foreach ($paises as $index => $pais)
                <li class="list-group-item" wire:key='pais--{{$index}}' wire:mouseenter='changeActive("{{$pais}}")'>
                    {{$pais}}
                    <button class="btn btn-danger btn-icon btn-circle" style="margin-left:15px" wire:click='delete({{$index}})'>
                        <i class="fa-solid fa-delete-left" ></i>
                    </button>    
                </li>   
            @endforeach
        @endif

        <span>{{$active}}</span>
    </ul>
</div>
