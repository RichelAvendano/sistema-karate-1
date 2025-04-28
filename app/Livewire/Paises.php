<?php

namespace App\Livewire;

use Livewire\Component;

class Paises extends Component
{
    public $paises = [
        'Venezuela',
        'Colombia',
        'Chile'
    ];

    public $pais,$errorMessage, $index, $active, $numIncrement = 0, $open = true;

    public function save()
    {
        unset($errorMessage);
        foreach ($this->paises as $pais) {
            if (strtolower($this->pais) == strtolower($pais)) {
                $this->errorMessage = 'Este país ya está en la lista.'; // Guardar error en la variable
                return;
            }
        }

        array_push($this->paises, strtolower($this->pais));
        $this->reset('pais','errorMessage'); // Resetear el campo y el mensaje de error
    }

    public function delete($index){
        unset($this->paises[$index]);
    }

    public function changeActive($pais){
        $this->active = $pais;
    }

    public function increment($num){
        $this->numIncrement += $num;
    }


    public function render()
    {
        return view('livewire.paises');
    }
}
