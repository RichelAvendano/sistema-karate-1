<?php

namespace App\Livewire\ViewStudent;

use App\Models\Dojo;
use App\Models\Sensei;
use App\Models\Student;
use Livewire\Component;
use App\Models\SuperAdmin;
use App\Models\User;
use Livewire\Attributes\On; // ¡Importa este atributo!
use Livewire\WithPagination;
use Illuminate\Validation\Rules;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class ComponentViewStudent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $listeners = ['refreshPhotoSensei' => 'render'];

    public $closeAnimation, $successMessage, $message = '', $id_student;

    public $id_selected, $password, $password_confirmation, $name, $email, $user_id_selected;

    public $selectedValueSearch, $selectedIconSearch, $selectedLabelSearch, $search = '', $sortBy = 'students.name', $sortDirection = 'desc' ;

    public $selectedValueSearchStudent, $selectedIconSearchStudent, $selectedLabelSearchStudent, $searchStudent = '', $sortByStudent = 'name', $sortDirectionStudent = 'desc', $studentsActiveSelected = true, $studentsInactiveSelected = false;

    public $changeTable, $optionsDojos, $students, $statusSensei, $statusModalConfirm, $student_id_selected, $id_selected_dojo;

    public $selectedLabel = 'Selecciona un dojo',$selectedPhoto='', $selectedSubtitle = '', $selectedActive;

    /* Variables para el Sensei */
    public $nameSensei, $emailSensei, $passwordSensei, $passwordConfirmationSensei,$dateOfBirthSensei, $organizationSensei,$photoSensei,$photoSenseiKey,$photoModalSensei, $roleSensei = "sensei", $dojoIdSensei = false, $isLoaded;

    public $optionsSearch = [
        [
            'value' => 'students.name',
            'title' => 'Nombre del Estudiante',
            'icon' => 'fa-solid fa-user-graduate'
        ],
        [
            'value' => 'users.email',
            'title' => 'Correo',
            'icon' => 'fa-solid fa-envelope'
        ],
        [
            'value' => 'students.kyu',
            'title' => 'Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => 'senseis.name',
            'title' => 'Nombre del Sensei',
            'icon' => 'fa-solid fa-user-ninja'
        ],
        [
            'value' => 'dojos.name',
            'title' => 'Dojo',
            'icon' => 'fa-solid fa-vihara'
        ],       
    ];

    public $optionsSearchStudent = [
        [
            'value' => 'name',
            'title' => 'Nombre',
            'icon' => 'fa-solid fa-user-ninja'
        ],
        [
            'value' => 'dan',
            'title' => 'dan',
            'icon' => 'fa-solid fa-ribbon'
        ],   
    ];

    public $selectedValueDan, $selectedIconDan, $selectedValueKyu, $selectedIconKyu, $selectedIconKyuColor;

    public $optionsDan = [
        [
            'value' => '1er Kyu',
            'icon' => 'fa-solid fa-ribbon',
        ],
        [
            'value' => '2do Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '3er Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '4to Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '5to Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '6to Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '7mo Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '8vo Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '9no Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '10mo Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],
    ];

    public function render()
    {

        $studentsInactive = Sensei::query()
            ->has('dojo')
            ->where('dojo_id','!=',$this->id_selected)
            ->when($this->searchStudent, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValueSearchStudent, 'like', '%'.$this->searchStudent.'%');
                    
                });
            })
            ->orderBy($this->sortByStudent, $this->sortDirectionStudent)
            ->paginate(2, ['*'], 'studentsActivePage');
        
        $studentsActive = Sensei::query()
            ->has('student')
            ->has('dojo')
            ->where('dojo_id','=',$this->id_selected)
            ->when($this->searchStudent, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValueSearchStudent, 'like', '%'.$this->searchStudent.'%');
                    
                });
            })
            ->orderBy($this->sortByStudent, $this->sortDirectionStudent)
            ->paginate(4, ['*'], 'studentsInactivePage');

        $students = Student::query()
            ->join('users', 'students.user_id', '=', 'users.id')
            ->leftJoin('senseis', 'students.sensei_id', '=', 'senseis.id')
            ->leftJoin('dojos', 'senseis.dojo_id', '=', 'dojos.id')
            ->select(
                'students.id',
                'students.kyu',
                'students.user_id',
                'students.date_of_birth AS dateOfBirth',
                'students.organization',
                'students.photo',
                'students.status',
                'students.name AS studentName',
                'senseis.name AS senseiName',
                'senseis.status AS senseiStatus',
                'users.created_at',
                'users.updated_at', 
                'dojos.name AS dojoName',
                'dojos.id AS dojoId',
                'users.email',
            )
            ->where($this->selectedValueSearch, 'like', '%'.$this->search.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(4, ['*'], 'studentsPage');
        $this->isLoaded = true;

        $this->optionsDojos = Sensei::has('dojo')->orWhere('id', $this->selectedActive)->get()->map(function ($dojo) {
            return [
                'value' => $dojo->id, // ✅ Ajusta según tu tabla
                'title' => $dojo->name,
                'subtitle' => $dojo->dojo->name,
                'photo' => $dojo->photo
            ];
        })->toArray();

        return view('livewire.view-student.component-view-student', [
            'studentsTotal' => $students,
            'studentsActive' => $studentsActive,
            'studentsInactive' => $studentsInactive
        ]);
    }

    public function mount()
    {
        $this->selectedValueSearchStudent = 'name';
        $this->selectedLabelSearchStudent = 'Nombre';
        $this->selectedIconSearchStudent = 'fa-solid fa-user-ninja';
        
        if(session('searchUser'))
        {
            $this->search = session('searchUser');
            $this->selectedValueSearch = 'users.email';
            $this->selectedLabelSearch = 'Correo';
            $this->selectedIconSearch = 'fa-solid fa-envelope';
        }else{
            $this->selectedValueSearch = 'students.name';
            $this->selectedLabelSearch = 'Nombre del Estudiante';
            $this->selectedIconSearch = 'fa-solid fa-user-graduate';
        }

        
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

    public function updateSensei()
    {
        $birthDate = \Carbon\Carbon::parse($this->dateOfBirthSensei);
        if ($birthDate->age < 1) {
            $this->addError('dateOfBirthSensei', 'Debe tener al menos 18 años');
            return;
        }
        
        $sensei = Student::find($this->id_selected);

        if (!$this->photoSensei) {
            $this->addError('photoSensei', 'Debes subir una imagen antes de enviar.');
            return;
        }
        $this->validate(
            [
                'nameSensei' => ['required', 'string', 'min:8'],
                'emailSensei' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$sensei->user_id], // ✅ Evita duplicidad
                'passwordSensei' => ['nullable', Rules\Password::defaults()], // ✅ `nullable` para que no sea obligatorio actualizar
                'passwordConfirmationSensei' => ['nullable', 'same:passwordSensei'],
                'selectedValueDan' => ['required', 'string'],
                'organizationSensei' => ['required', 'string'],
                'dateOfBirthSensei' => ['required', 'date'],
                'photoSensei' => [$this->photoSensei instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile ? 'image' : 'nullable'],
            ],
            attributes: [
                'nameSensei' => 'nombre del sensei',
                'emailSensei' => 'correo electrónico',
                'passwordSensei' => 'contraseña',
                'passwordConfirmationSensei' => 'confirmación de contraseña',
                'selectedValueDan' => 'nivel de Dan',
                'organizationSensei' => 'organización',
                'dateOfBirthSensei' => 'fecha de nacimiento',
                'photoSensei' => 'foto de perfil',
            ]
        );

        // ✅ Buscar el Sensei y su usuario asociado
        

        $user = User::find($sensei->user_id);

        // ✅ Actualizar datos del usuario
        $user->email = $this->emailSensei;
        if (!empty($this->passwordSensei)) { // ✅ Solo actualizar si hay una nueva contraseña
            $user->password = bcrypt($this->passwordSensei);
        }
        $user->save();

        // ✅ Actualizar datos del Sensei

        $dojo = Sensei::where('id', $this->dojoIdSensei)->first();
        $dojo_id = $dojo ? $dojo->dojo_id : null; // ✅ Obtener el dojo_id del Sensei

        $sensei->update([
            'name' => $this->nameSensei,
            'sensei_id' => $this->dojoIdSensei,
            'dojo_id' => $dojo_id,
            'kyu' => $this->selectedValueDan,
            'date_of_birth' => $this->dateOfBirthSensei,
            'organization' => $this->organizationSensei,
            'status' => $this->dojoIdSensei ? 'activo' : 'inactivo' // ✅ Actualiza estado según dojo
        ]);

        

        if ($this->photoSensei instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $originalExtension = $this->photoSensei->getClientOriginalExtension();
            $newFileName = 'sensei-photo-(N-'.$sensei->id.').'.$originalExtension;
            $imagePathRelativeToDisk = $this->photoSensei->storeAs('senseis', $newFileName, 'public');
        
            $sensei->photo = $imagePathRelativeToDisk;
            $sensei->save();

        
            $this->photoSenseiKey = rand(); // ✅ Para refrescar la imagen en la vista
        }
        
        $this->dispatch('refreshPhotoSensei');

        $this->message = 'Sensei actualizado exitosamente';
        $this->successMessage = true;
    }


    public function editModal($id_selected)
    {
        // ✅ Limpiar variables previas
        $this->reset([
            'nameSensei', 'emailSensei', 'passwordSensei', 'passwordConfirmationSensei',
            'selectedValueDan', 'organizationSensei', 'dateOfBirthSensei', 'photoSensei'
        ]);

        $this->resetErrorBag(); // ✅ Borra los errores previos
        $this->resetValidation();

        // ✅ Guardar el ID del Sensei seleccionado
        $this->id_selected = $id_selected;

        $student = Student::query()
            ->join('users', 'students.user_id', '=', 'users.id')
            ->leftJoin('senseis', 'students.sensei_id', '=', 'senseis.id')
            ->leftJoin('dojos', 'senseis.dojo_id', '=', 'dojos.id')
            ->select(
                'students.id',
                'students.kyu',
                'students.user_id',
                'students.date_of_birth AS dateOfBirth',
                'students.organization',
                'students.photo AS photoStudent',
                'students.status',
                'students.name AS studentName',
                'senseis.name AS senseiName',
                'senseis.id AS sensei_id',
                'users.created_at',
                'users.updated_at', 
                'dojos.name AS dojoName',
                'dojos.id AS dojoId',
                'users.email',
            )
            ->where('students.id', $id_selected) // ✅ Filtrar por el ID seleccionado
            ->first(); // ✅ Obtener solo un registro

        if ($student) { // ✅ Verificar que el Sensei existe antes de asignar valores
            $this->nameSensei = $student->studentName;
            $this->emailSensei = $student->email;
            $this->selectedValueDan = $student->kyu;
            $this->organizationSensei = $student->organization;
            $this->dateOfBirthSensei = $student->dateOfBirth;
            $this->photoSensei = $student->photoStudent;
            $this->dojoIdSensei = $student->sensei_id;
            $this->selectedActive = $this->dojoIdSensei;
            $this->selectedIconDan = 'fa-solid fa-ribbon';

            if($this->dojoIdSensei){
                $dojoSelect = Sensei::find($this->dojoIdSensei);
                $this->selectedLabel = $dojoSelect->name;
                $this->selectedSubtitle = $dojoSelect->dojo->name;
                $this->selectedPhoto = $dojoSelect->photo;
            }

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

    public function destroyModal($id, $id_user){
        $this->message = '¿Está seguro que quiere eliminar el   Estudiante?';
        $this->id_selected = $id;
        $this->user_id_selected = $id_user;
    }

    public function destroy($id, $id_user)
    {
        
        $sensei = Student::find($id);

        $imagePath = $sensei->photo;

        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $sensei->delete();
        User::find($id_user)->delete();
        $this->message = 'Estudiante Eliminado Exitosamente';
        $this->successMessage = true;
        $this->changeTable = true;
        $this->dispatch('changeTableFalse');

    }

    public function selectOption($index)
    {
        if($index == 'inactivo')
        {
            $this->dojoIdSensei = null;
        }
        else
        {
            $option = $this->optionsDojos[$index];

            $this->dojoIdSensei = $option['value'];
            $this->selectedLabel = $option['title'];
            $this->selectedSubtitle = $option['subtitle'];
            $this->selectedPhoto = $option['photo'];
        }
        
    }

    public function selectOptionStudent($index)
    {

        $option = $this->optionsSearchStudent[$index];

        $this->selectedValueSearchStudent = $option['value'];
        $this->selectedLabelSearchStudent = $option['title'];
        $this->selectedIconSearchStudent = $option['icon'];      
    }

    public function selectOptionDan($index)
    {
        $option = $this->optionsDan[$index];
        $this->selectedValueDan = $option['value'];
        $this->selectedIconDan = $option['icon'];
    }

    public function studentsSensei($id, $statusSensei, $id_student)
    {
        $this->id_student = $id_student;
        $this->id_selected = $id;
        $this->statusSensei = $statusSensei;

    }

    public function studentsActive()
    {   
        $this->studentsActiveSelected = true;
        $this->studentsInactiveSelected = false;
        $this->changeTable = true;
        $this->dispatch('changeTableFalse');
    }

    public function studentsInactive()
    {

        $this->studentsActiveSelected = false;
        $this->studentsInactiveSelected = true;
        
        $this->changeTable = true;
        $this->dispatch('changeTableFalse');
        //$this->students = Student::where('sensei_id','=',null)->get();

    }

    public function addStudentSensei()
    {
        Student::find($this->id_student)->update([
            'sensei_id' => $this->student_id_selected,
            'status' => 'activo',
        ]);

    }

    public function removeStudentSensei()
    {
        Student::find($this->id_student)->update([
            'sensei_id' => null,
            'status' => 'inactivo',
        ]);

    }

    public function modalConfirmStudent($status, $idStudent)
    {
        $this->student_id_selected = $idStudent;
        $this->statusModalConfirm = $status;
    }

    public function removephotoSensei()
    {
        $this->photoSensei = '';
    }

}
