<?php

namespace App\Livewire;

use App\Models\Sensei;
use App\Models\Student;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MainNavbar extends Component
{
    public $user, $userPhoto;

    public function mount(){
        $idUser = Auth::user()->id;
        $role = Auth::user()->role; 
        
        if($role == 'sensei')
        {
            $this->user = Sensei::where('user_id', $idUser)->first();
            
        }elseif($role == 'administrador'){
            $this->user = SuperAdmin::where('user_id', $idUser)->first();
        }else{
            $this->user = Student::where('user_id', $idUser)->first();
        }
    }

    public function render()
    {
        return view('livewire.main-navbar');
    }
}
