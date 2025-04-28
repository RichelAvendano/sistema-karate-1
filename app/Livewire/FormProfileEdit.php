<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FormProfileEdit extends Component
{   
    public $name, $role, $email;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->role = $user->role;
        $this->email = $user->email;
    }

    public function save()
    {

        User::where('id', Auth::user()->id)
            ->update([
                'name' => $this->name,
                'role' => $this->role,
                'email' => $this->email
            ]);
        

        session()->flash('message', 'Perfil Actualizado');
    }

    public function render()
    {
        return view('livewire.form-profile-edit');
    }
}
