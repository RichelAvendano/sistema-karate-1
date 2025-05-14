<?php

namespace App\Livewire\ViewAdmin;

use App\Models\SuperAdmin;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On; // ¡Importa este atributo!
use Livewire\WithPagination;
use Illuminate\Validation\Rules;


class ComponentViewAdmin extends Component
{
    use WithPagination;

    public $closeAnimation, $successMessage, $message = '';

    public $id_selected, $password, $password_confirmation, $name, $email;

    public $selectedValueSearch, $selectedIconSearch, $selectedLabelSearch, $search = '', $sortBy = 'created_at', $sortDirection = 'desc' ;

    public $changeTable;

    public $optionsSearch = [
        [
            'value' => 'name',
            'title' => 'Nombre',
            'icon' => 'fa-solid fa-user'
        ],
        [
            'value' => 'email',
            'title' => 'Correo',
            'icon' => 'fa-solid fa-envelope'
        ],
        [
            'value' => 'role',
            'title' => 'Rol',
            'icon' => 'fa-solid fa-user-shield'
        ],
        
    ];

    public function render()
    {

        $users = SuperAdmin::query()
            ->join('users', 'super_admins.user_id', '=', 'users.id') 
            ->where($this->selectedValueSearch, 'like', '%'.$this->search.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(4);

        return view('livewire.view-admin.component-view-admin', [
            'users' => $users
        ]);
    }

    public function mount()
    {
        if(session('searchUser'))
        {
            $this->search = session('searchUser');
        }

        $this->selectedValueSearch = 'email';
        $this->selectedLabelSearch = 'Correo';
        $this->selectedIconSearch = 'fa-solid fa-envelope';
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

    public function selectOptionSearch($index)
    {
        $option = $this->optionsSearch[$index];
        $this->selectedValueSearch = $option['value'];
        $this->selectedLabelSearch = $option['title'];
        $this->selectedIconSearch = $option['icon'];
    }

    #[On('closeSuccess')]
    public function closeSuccess(){
        sleep(0.7);
        $this->closeAnimation = false;
        $this->successMessage = false;
    }

    #[On('changeTableFalse')]
    public function changeTableFalse(){
        sleep(0.7);
        $this->changeTable = false;
    }

    public function clearSuccessMessage()
    {
        $this->closeAnimation = true;
        $this->dispatch('closeSuccess');
        
    }

    public function editModal($id_selected)
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->resetErrorBag(); // ✅ Borra los errores previos al abrir el modal
        $this->resetValidation();

        $this->id_selected = $id_selected;

        $admin = SuperAdmin::query()
            ->join('users', 'super_admins.user_id', '=', 'users.id')
            ->where('super_admins.user_id', $id_selected) // ✅ Filtrar por el ID seleccionado
            ->select('super_admins.name', 'users.email') // ✅ Seleccionar los datos necesarios
            ->first(); // ✅ Obtener solo un registro

        if ($admin) { // ✅ Verificar si existe antes de asignar
            $this->name = $admin->name;
            $this->email = $admin->email;
        }
    }

    public function editAdmin($id)
    {
        $this->validate([
            'name' => 'required|string', // Permite actualizar el mismo registro
            'email' => 'required|string|unique:users,email,'.$id,
            'password' => ['required', Rules\Password::defaults(), 'confirmed'],
        ]);

        $user = User::find($id);
        $user->update([
            'email' => $this->email,
            'password' =>  $this->password,
        ]);

        SuperAdmin::where('user_id', '=', $id)->update([
            'name' => $this->name,
        ]);;

        $this->message = 'Dojo actualizado exitosamente';
        $this->successMessage = true;
        
        $this->changeTable = true;
        $this->dispatch('changeTableFalse');
    }

    public function destroyModal($id){
        $this->message = '¿Está seguro que quiere eliminar el Administrador?';
        $this->id_selected = $id;
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        SuperAdmin::where('user_id', '=', $id)->delete();

        $this->message = 'Dojo Eliminado Exitosamente';
        $this->successMessage = true;
        $this->changeTable = true;
        $this->dispatch('changeTableFalse');

    }
    
}
