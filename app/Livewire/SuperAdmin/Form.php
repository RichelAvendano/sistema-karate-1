<?php

namespace App\Livewire\SuperAdmin;

use App\Models\Dojo;
use App\Models\Sensei;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Validation\Rules;
use Livewire\Attributes\On; // ¡Importa este atributo!
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Form extends Component
{   
    use WithPagination;
    use WithFileUploads;

    /* Variables para la Busqueda */
    public $closeAnimation, $message, $successMessage = false;

    /* Variables para la Busqueda */
    public $selectedValue = null,$selectedLabel = 'Selecciona un dojo',$selectedSubtitle = '', $search = '', $sortBy = 'name', $sortDirection = 'asc';

    /* Variables Generales para los Form */
    public $photoSave, $photoKey;

    /* Variables para el administrador */
    public $nameAdmin, $emailAdmin, $passwordAdmin, $passwordConfirmationAdmin, $roleAdmin = "admin";

    public $options = [
        [
            'value' => 'Name',
            'title' => 'Name',
            'subtitle' => 'Tokio, Japón',
        ],
        [
            'value' => 'Location',
            'title' => 'Location',
            'subtitle' => 'Osaka, Japón',
        ],
    ];

    public function render()
    {
        $dojos = Dojo::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValue, 'like', '%'.$this->search.'%');
                    
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(2);

        return view('livewire.super-admin.form', [
            'dojos' => $dojos
        ]);
    }

    public function mount (){
        $this->selectedValue = 'Name';
        $this->selectedLabel = 'Name';
        $this->selectedSubtitle = 'Tokio, Japón';
    }

    public function sortByModel($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function selectOption($index)
    {
        $option = $this->options[$index];
        $this->selectedValue = $option['value'];
        $this->selectedLabel = $option['title'];
        $this->selectedSubtitle = $option['subtitle'];
    }

    public function saveAdmin()
    {
        $this->validate([
            'nameAdmin' => ['required', 'string', 'min:8'],
            'emailAdmin' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'passwordAdmin' => ['required', Rules\Password::defaults()],
            'passwordConfirmationAdmin' => ['required' , 'same:passwordAdmin']
        ]);

        $user = User::create([
            'email' => $this->emailAdmin,
            'password' =>  $this->passwordAdmin,
            'role' => $this->roleAdmin

        ]);

        if ($user) { // ✅ Asegurar que el usuario se creó correctamente
            SuperAdmin::create([
                'name' => $this->nameAdmin,
                'user_id' => $user->id // ✅ Asegurar que `user_id` tiene un valor válido
            ]);
        } else {
            dd('Error al crear el usuario'); // 💡 Depuración en caso de fallo
        }

        $this->reset('nameAdmin', 'emailAdmin', 'passwordAdmin', 'passwordConfirmationAdmin');

        $this->message = 'Administrador Creado Exitosamente';
        $this->successMessage = true;
    }

    public function clearSuccessMessage()
    {
        $this->closeAnimation = true;
        $this->dispatch('closeSuccess');
        
    }

    #[On('closeSuccess')]
    public function closeSuccess()
    {
        sleep(0.7);
        $this->closeAnimation = false;
        $this->successMessage = false;
    }

}
