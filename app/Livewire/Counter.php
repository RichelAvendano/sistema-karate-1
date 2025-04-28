<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Counter extends Component
{
    public $count = 1, $title, $user;
    public $name, $email, $role;
 
    public function increment($num = 1)
    {
        $this->count += $num;
    }
 
    public function decrement()
    {   
        if($this->count >= 1){
            $this->count--;
        }
    }

    // This method is called when the component is initialized
    public function mount(User $user){

        //$this->name = $user->name;
        $this->fill(
            $user->only(['name', 'email', 'role'])
        );
    }
    
    public function save(){
        //dd($this->name);
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
