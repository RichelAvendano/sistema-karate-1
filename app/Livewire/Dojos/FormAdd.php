<?php

namespace App\Livewire\Dojos;

use App\Models\Dojo;
use App\Models\Sensei;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On; // ¡Importa este atributo!
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class FormAdd extends Component
{   
    use WithPagination;
    use WithFileUploads;

    public $name='', $description='', $location='', $photo,$photoSave, $photoName='Selecciona un Archivo',$photoKey, $id_selected, $modal, $successMessage = false, $cardDojos = true, $tableDojos = false;

    public $nameEdit='', $descriptionEdit='', $locationEdit='', $photoEdit='', $message, $destroyMessage = false, $changeTable = false, $closeAnimation = false, $validateLabel = false, $photoModal = false, $saveModal = false, $closeAnimationSave = false;

    public $selectedValue = null,$selectedLabel = 'Selecciona un dojo',$selectedIcon = '', $search = '', $sortBy = 'name', $sortDirection = 'asc';

    public $options = [
        [
            'value' => 'Name',
            'title' => 'Nombre',
            'icon' => 'fa-solid fa-vihara'
        ],
        [
            'value' => 'Location',
            'title' => 'Ubicacion',
            'icon' => 'fa-solid fa-location-dot'
        ],
    ];

    protected $listeners = ['dojoAdded' => 'loadDojos']; // Escuchar el evento

    public function mount(){
        $this->modal = false;
        $this->selectedValue = 'Name';
        $this->selectedLabel = 'Name';
        $this->selectedIcon = 'fa-solid fa-vihara';
    }

    public function updatedPhoto()
    {
        // Guardar el nombre del archivo al seleccionarlo
        $this->photoName = $this->photo->getClientOriginalName();
    }

    public function modalSave(){
        if($this->saveModal == true){
            $this->closeAnimationSave = true;
            $this->dispatch('closeSave');
        }else{
            $this->saveModal = true;
        } 
    }

    public function removePhotoSave(){
        $this->photoSave = '';
    }

    public function removePhoto(){
        $this->photo = '';
    }

    public function save(){
        $this->validate(
            [
                'name' => 'required|string|max:255|unique:dojos,name',
                'description' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'photoSave' => 'required|image'
            ],
            attributes: [
                'name' => 'nombre del dojo',
                'description' => 'descripción',
                'location' => 'ubicación',
                'photoSave' => 'foto del dojo',
            ]
        );


        $dojo = Dojo::create([
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
        ]);

        if($this->photoSave){

            $originalExtension = $this->photoSave->getClientOriginalExtension();

            $newFileName = 'dojo-photo-(N-'.$dojo->id.').'.$originalExtension;

            $imagePathRelativeToDisk = $this->photoSave->storeAs('dojos', $newFileName, 'public');

            $dojo->photo = $imagePathRelativeToDisk;

            $dojo->save();

            $this->photoKey = rand();
            $this->photoName = 'Selecciona un Archivo';
        }

        $this->reset(['name', 'description', 'location', 'photoSave']);
        
        $this->message = 'Dojo Creado Exitosamente';
        $this->successMessage = true;

        $this->dispatch('refreshForm'); // Enviar evento para actualizar la UI

        $this->changeTable = true;
        $this->dispatch('changeTableFalse');
    }

    #[On('closePhoto')]
    public function closePhoto(){
        sleep(0.7);
        $this->closeAnimation = false;
        $this->photoModal = false;
    }

    #[On('closeSave')]
    public function closeSave(){
        sleep(0.7);
        $this->closeAnimationSave = false;
        $this->saveModal = false;
    }

    #[On('closeDestroy')]
    public function closeDestroy(){
        sleep(0.7);
        $this->closeAnimation = false;
        $this->destroyMessage = false;
    }

    #[On('closeEdit')]
    public function closeEdit(){
        sleep(0.7);
        $this->closeAnimation = false;
        $this->modal = false;
    }

    #[On('closeSuccess')]
    public function closeSuccess(){
        sleep(0.7);
        $this->closeAnimation = false;
        $this->successMessage = false;
    }

    
    public function closeEditAnimation(){
        $this->closeAnimation = true;
        $this->dispatch('closeEdit');
    }

    public function edit($id_selected){

        $this->id_selected = $id_selected;
        $this->modal = true;
        /* $this->validate([
            'name' => 'required|string|max:255|unique:dojos,name',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Dojo::where('id', $id_selected)
            ->update([
                'name' => $this->name,
                'role' => $this->role,
                'email' => $this->email
            ]); */

        $dojo = Dojo::find($id_selected);
        $this->nameEdit = $dojo->name;
        $this->descriptionEdit = $dojo->description;
        $this->locationEdit = $dojo->location;
        $this->photo = $dojo->photo;
    }

    public function editSave($id)
    {
        $this->validate(
            [
                'nameEdit' => 'required|string|max:255|unique:dojos,name,' . $id, // Permite actualizar el mismo registro
                'descriptionEdit' => 'required|string|max:255',
                'locationEdit' => 'required|string|max:255',
                'photo' => 'required|image'
            ],
            attributes: [
                'nameEdit' => 'nombre del dojo',
                'descriptionEdit' => 'descripción',
                'locationEdit' => 'ubicación',
                'photo' => 'foto del dojo',
            ]
        );

        

        $dojo = Dojo::find($id); // Usa el parámetro de la función en lugar de $this->id_selected
        $dojo->update([
            'name' => $this->nameEdit,
            'description' => $this->descriptionEdit,
            'location' => $this->locationEdit,
        ]);

        if($this->photo){

            $oldImagePath = $dojo->photo;

            if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
                // Opcional: Puedes añadir manejo de errores si la eliminación falla
            }
            
            $originalExtension = $this->photo->getClientOriginalExtension();
            $newFileName = 'dojo-photo-(N-'.$dojo->id.').'.$originalExtension;

            $imagePathRelativeToDisk = $this->photo->storeAs('dojos', $newFileName, 'public');

            $dojo->photo = $imagePathRelativeToDisk;
            $dojo->save();
            
            $this->photoKey = rand();
            $this->photoName = 'Selecciona un Archivo';
        }

        $this->mount();
        
        $this->message = 'Dojo actualizado exitosamente';
        $this->successMessage = true;
        
        $this->changeTable = true;
        $this->dispatch('changeTableFalse');
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

    public function destroyModal($id){
        $this->destroyMessage = true;
        $this->message = '¿Está seguro que quiere eliminar el dojo?';
        $this->id_selected = $id;
    }

    public function closeDestroyModal(){
        $this->closeAnimation = true;
        $this->dispatch('closeDestroy');
    }
    
    public function destroy($id)
    {
        $dojo = Dojo::find($id);

        if ($dojo) {
            // ✅ Buscar el sensei asociado al dojo
            $sensei = Sensei::where('dojo_id', $id)->first(); 
            
            // ✅ Si hay sensei, quitar relación con estudiantes
            if ($sensei) {
                Student::where('sensei_id', $sensei->id)->update(['sensei_id' => null, 'status' => 'inactivo']); // ✅ Ahora sí podemos acceder a $sensei->id
                $sensei->update(['dojo_id' => null, 'status' => 'inactivo']); // ✅ También desvincular sensei del dojo
            }

            // ✅ Finalmente eliminar el dojo
            $dojo->delete();
        }

        $imagePath = $dojo->photo;

        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $this->message = 'Dojo Eliminado Exitosamente';
        $this->destroyMessage = false;
        $this->successMessage = true;
        $this->changeTable = true;
        $this->dispatch('changeTableFalse');

    }

    public function updatedPage($page)
    {
        $this->changeTable = true;
        $this->dispatch('changeTableFalse');
    }

    public function viewImage()
    {
        $this->photoModal = true;
    }

    public function closeViewImage()
    {
        $this->closeAnimation = true;
        $this->dispatch('closePhoto');
    }

    public function updated($propertyName)
    {
        $this->resetErrorBag($propertyName); // ✅ Borra el error cuando el usuario escribe
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
        $this->selectedIcon = $option['icon'];
    }

    public function showCardDojos(){
        if($this->cardDojos == true)
            $this->cardDojos = false;
        else{
            $this->cardDojos = true;
            $this->tableDojos = false;
        }
    }

    public function showTableDojos(){
        if($this->tableDojos == true)
            $this->tableDojos = false;
        else{
            $this->tableDojos = true;
            $this->cardDojos = false;
        }
    }

    public function render()
    {
        $dojos = Dojo::query()
            ->with('sensei')
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValue, 'like', '%'.$this->search.'%');
                    
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(4);

        return view('livewire.dojos.form-add', [
            'dojos' => $dojos
        ]);
    }
}
