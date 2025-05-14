<?php

namespace App\Livewire\SuperAdmin;

use App\Models\Dojo;
use App\Models\Sensei;
use App\Models\Student;
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

    /* Variables para El Select */
    public $selectedLabel = 'Selecciona un dojo',$selectedPhoto='', $selectedSubtitle = '',$optionsDojos, $selectedLabelStudent = 'Selecciona un Sensei',$selectedPhotoStudent='', $selectedSubtitleStudent = '',$optionStudent;

    public $selectedValueSearch, $selectedIconSearch, $selectedLabelSearch, $search = '', $sortBy = 'created_at', $sortDirection = 'desc' ;

    public $selectedValueDan, $selectedIconDan, $selectedValueKyu, $selectedIconKyu, $selectedIconKyuColor;

    public $optionsSearch = [
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

    public $optionsDan = [
        [
            'value' => '1er Dan',
            'icon' => 'fa-solid fa-ribbon',
        ],
        [
            'value' => '2do Dan',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '3er Dan',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '4to Dan',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '5to Dan',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '6to Dan',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '7mo Dan',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '9no Dan',
            'icon' => 'fa-solid fa-ribbon'
        ],
        [
            'value' => '10mo Dan',
            'icon' => 'fa-solid fa-ribbon'
        ],
    ];

    public $optionsKyu = [
        [
            'value' => '1er Kyu',
            'icon' => 'fa-solid fa-ribbon',
            'color' => 'brown'
        ],
        [
            'value' => '2do Kyu',
            'icon' => 'fa-solid fa-ribbon',
            'color' => 'brown'
        ],
        [
            'value' => '3er Kyu',
            'icon' => 'fa-solid fa-ribbon',
            'color' => 'brown'
        ],
        [
            'value' => '4to Kyu',
            'icon' => 'fa-solid fa-ribbon',
            'color' => 'purple'
        ],
        [
            'value' => '5to Kyu',
            'icon' => 'fa-solid fa-ribbon',
            'color' => 'rgb(15, 15, 146)'
        ],
        [
            'value' => '6to Kyu',
            'icon' => 'fa-solid fa-ribbon',
            'color' => 'green'

        ],
        [
            'value' => '7mo Kyu',
            'icon' => 'fa-solid fa-ribbon',
            'color' => 'orange'
        ],
        [
            'value' => '8mo Kyu',
            'icon' => 'fa-solid fa-ribbon',
            'color' => 'yellow'
        ],
        [
            'value' => '9no Kyu',
            'icon' => 'fa-solid fa-ribbon',
            'color' => 'white'
        ],
        [
            'value' => '10mo Kyu',
            'icon' => 'fa-solid fa-ribbon',
            'color' => 'white'
        ],
    ];

    /* Variables para el administrador */
    public $nameAdmin, $emailAdmin, $passwordAdmin, $passwordConfirmationAdmin, $roleAdmin = "administrador";

    /* Variables para el Sensei */
    public $nameSensei, $emailSensei, $passwordSensei, $passwordConfirmationSensei,$dateOfBirthSensei, $organizationSensei,$photoSensei,$photoSenseiKey,$photoModalSensei, $roleSensei = "sensei", $dojoIdSensei = null;


    /* Variables para el Student */
    public $nameStudent, $emailStudent, $passwordStudent, $passwordConfirmationStudent,$kyuStudent,$dateOfBirthStudent, $organizationStudent,$photoStudent,$photoStudentKey,$photoModalStudent, $roleStudent = "estudiante", $dojoIdStudent = null;


    public function render()
    {   
        $this->optionsDojos = Dojo::doesntHave('sensei')->get()->map(function ($dojo) {
            return [
                'value' => $dojo->id, // ✅ Ajusta según tu tabla
                'title' => $dojo->name,
                'subtitle' => $dojo->location,
                'photo' => $dojo->photo
            ];
        })->toArray();      

        $this->optionStudent = Sensei::with('dojo')->has('dojo')->get()->map(function ($sensei) {
            return [
                'value' => $sensei->id, // ✅ Ajusta según tu tabla
                'title' => $sensei->name,
                'subtitle' => $sensei->dojo->name,
                'photo' => $sensei->photo
            ];
        })->toArray();

        $users = User::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValueSearch, 'like', '%'.$this->search.'%');
                    
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(4);

        return view('livewire.super-admin.form', [
            'users' => $users
        ]);
    }

    public function mount ()
    { 
        $this->selectedValueSearch = 'email';
        $this->selectedLabelSearch = 'Correo';
        $this->selectedIconSearch = 'fa-solid fa-envelope';
    }

    public function sendSearchUser($emailUser, $role)
    {
        session()->flash('searchUser', $emailUser); // Guardar dato en sesión

        if($role == 'administrador')
        {
            return redirect()->route('view-admin');
        }elseif($role == 'sensei')
        {
            return redirect()->route('view-sensei');
        }elseif($role == 'estudiante')
        {
            return redirect()->route('view-student');
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

    public function selectOptionDan($index)
    {
        $option = $this->optionsDan[$index];
        $this->selectedValueDan = $option['value'];
        $this->selectedIconDan = $option['icon'];
    }

    public function selectOptionKyu($index)
    {
        $option = $this->optionsKyu[$index];
        $this->selectedValueKyu = $option['value'];
        $this->selectedIconKyu = $option['icon'];
        $this->selectedIconKyuColor = $option['color'];
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
        if($index == 'inactivo')
        {
            $this->dojoIdStudent = null;
        }
        else
        {
            $option = $this->optionStudent[$index];

            $this->dojoIdStudent = $option['value'];
            $this->selectedLabelStudent = $option['title'];
            $this->selectedSubtitleStudent = $option['subtitle'];
            $this->selectedPhotoStudent = $option['photo'];
        }
    }
    //
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
        $this->mount();
    }

    public function saveSensei()
    {
        $birthDate = \Carbon\Carbon::parse($this->dateOfBirthSensei);
        if ($birthDate->age < 12) {
            $this->addError('dateOfBirthSensei', 'Debe tener al menos 12 años');
            return;
        }

        $this->validate(
            [
                'nameSensei' => ['required', 'string', 'min:8'],
                'emailSensei' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'passwordSensei' => ['required', Rules\Password::defaults()],
                'passwordConfirmationSensei' => ['required', 'same:passwordSensei'],
                'selectedValueDan' => ['required', 'string'],
                'organizationSensei' => ['required', 'string'],
                'dateOfBirthSensei' => ['required', 'date'],
                'photoSensei' => ['image', 'required']
            ],
            attributes: [
                'nameSensei' => 'nombre del sensei',
                'emailSensei' => 'correo electrónico',
                'passwordSensei' => 'contraseña',
                'passwordConfirmationSensei' => 'confirmación de contraseña',
                'selectedValueDan' => 'nivel de Dan',
                'organizationSensei' => 'organización',
                'dateOfBirthSensei' => 'fecha de nacimiento',
                'photoSensei' => 'imagen del sensei',
            ]
        );


        $user = User::create([
            'email' => $this->emailSensei,
            'password' =>  $this->passwordSensei,
            'role' => $this->roleSensei

        ]);

        $sensei = Sensei::create([
            'name' => $this->nameSensei,
            'user_id' => $user->id,
            'dojo_id' => $this->dojoIdSensei,
            'dan' => $this->selectedValueDan,
            'date_of_birth' => $this->dateOfBirthSensei,
            'organization' => $this->organizationSensei,
            'photo' => $this->photoSensei,
        ]);

        if($this->dojoIdSensei == null)
        {
            $sensei->update(['status' => 'inactivo']);
        }       

        if($this->photoSensei){

            $originalExtension = $this->photoSensei->getClientOriginalExtension();

            $newFileName = 'sensei-photo-(N-'.$sensei->id.').'.$originalExtension;

            $imagePathRelativeToDisk = $this->photoSensei->storeAs('senseis', $newFileName, 'public');

            $sensei->photo = $imagePathRelativeToDisk;

            $sensei->save();

            $this->photoSenseiKey = rand();
        }

        $this->dispatch('dateOfBirthSensei');

        $this->reset('nameSensei', 'emailSensei', 'selectedValueDan', 'dateOfBirthSensei', 'organizationSensei', 'photoSensei', 'passwordSensei', 'passwordConfirmationSensei', 'selectedSubtitle', 'selectedPhoto', 'selectedLabel', 'dojoIdSensei'); 
        

        $this->message = 'Sensei Creado Exitosamente';
        $this->successMessage = true;
    }

    public function saveStudent()
    {
        $birthDate = \Carbon\Carbon::parse($this->dateOfBirthStudent);
        if ($birthDate->age < 1) {
            $this->addError('dateOfBirthStudent', 'Debe tener al menos 1 años');
            return;
        }

        $this->validate(
            [
                'nameStudent' => ['required', 'string', 'min:8'],
                'emailStudent' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'passwordStudent' => ['required', Rules\Password::defaults()],
                'passwordConfirmationStudent' => ['required', 'same:passwordStudent'],
                'selectedValueKyu' => ['required', 'string'],
                'organizationStudent' => ['required', 'string'],
                'dateOfBirthStudent' => ['required', 'date'],
                'photoStudent' => ['required', 'image']
            ],
            attributes: [
                'nameStudent' => 'nombre del estudiante',
                'emailStudent' => 'correo electrónico',
                'passwordStudent' => 'contraseña',
                'passwordConfirmationStudent' => 'confirmación de contraseña',
                'selectedValueKyu' => 'nivel de Kyu',
                'organizationStudent' => 'organización',
                'dateOfBirthStudent' => 'fecha de nacimiento',
                'photoStudent' => 'foto del estudiante',
            ]
        );


        $user = User::create([
            'email' => $this->emailStudent,
            'password' =>  $this->passwordStudent,
            'role' => $this->roleStudent

        ]);

        $dojo = Sensei::where('id', $this->dojoIdStudent)->first();
       
        $student = Student::create([
            'name' => $this->nameStudent,
            'user_id' => $user->id,
            'sensei_id' => $this->dojoIdStudent,
            'dojo_id' => $dojo?->dojo_id,
            'kyu' => $this->selectedValueKyu,
            'date_of_birth' => $this->dateOfBirthStudent,
            'organization' => $this->organizationStudent,
            'photo' => $this->photoStudent,
            'status' => $dojo ? 'activo' : 'inactivo',

        ]);

        if($this->dojoIdStudent == null)
        {
            $student->update(['status' => 'inactivo']);
        } 


        if($this->photoStudent){

            $originalExtension = $this->photoStudent->getClientOriginalExtension();

            $newFileName = 'Student-photo-(N-'.$student->id.').'.$originalExtension;

            $imagePathRelativeToDisk = $this->photoStudent->storeAs('students', $newFileName, 'public');

            $student->photo = $imagePathRelativeToDisk;

            $student->save();

            $this->photoStudentKey = rand();
        }

        $this->dispatch('dateOfBirthStudent');

        $this->reset('nameStudent', 'emailStudent', 'selectedValueKyu', 'dateOfBirthStudent', 'organizationStudent', 'photoStudent', 'passwordStudent', 'passwordConfirmationStudent', 'selectedSubtitle', 'selectedPhoto', 'selectedLabel', 'dojoIdStudent'); 
        

        $this->message = 'Estudiante Creado Exitosamente';
        $this->successMessage = true;
    }

    public function clearSuccessMessage()
    {
        $this->closeAnimation = true;
        $this->dispatch('closeSuccess');
        
    }
    //
    #[On('closeSuccess')]
    public function closeSuccess()
    {
        sleep(0.7);
        $this->closeAnimation = false;
        $this->successMessage = false;
    }

    #[On('closePhotoSensei')]
    public function closePhotoSensei(){
        sleep(0.7);
        $this->closeAnimation = false;
        $this->photoModalSensei = false;
    }

    #[On('closePhotoStudent')]
    public function closePhotoStudent(){
        sleep(0.7);
        $this->closeAnimation = false;
        $this->photoModalStudent = false;
    }

    public function viewImageSensei()
    {
        $this->photoModalSensei = true;
    }

    public function viewImageStudent()
    {
        $this->photoModalStudent = true;
    }

    public function closeViewImage()
    {
        $this->closeAnimation = true;
        $this->dispatch('closePhotoSensei');
    }

    public function closeViewImageStudent()
    {
        $this->closeAnimation = true;
        $this->dispatch('closePhotoStudent');
    }

    public function removePhotoSensei(){
        $this->photoSensei = '';
    }

    public function removePhotoStudent(){
        $this->photoStudent = '';
    }

}
