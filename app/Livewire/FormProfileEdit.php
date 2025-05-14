<?php

namespace App\Livewire;

use App\Models\Dojo;
use App\Models\Sensei;
use App\Models\Student;
use App\Models\SuperAdmin;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\WithFileUploads;

class FormProfileEdit extends Component
{   

    use WithFileUploads;

    public $role, $name, $email, $password, $password_confirmation, $admin,$sensei,$student, $id_user, $message;

    /* Variables para el Sensei */
    public $nameSensei, $emailSensei, $passwordSensei, $passwordConfirmationSensei,$dateOfBirthSensei, $organizationSensei,$photoSensei,$photoSenseiKey,$photoModalSensei, $roleSensei = "sensei";

    /* Variables para el Student */
    public $nameStudent, $emailStudent, $passwordStudent, $passwordConfirmationStudent,$dateOfBirthStudent, $organizationStudent,$photoStudent,$photoStudentKey,$photoModalStudent, $roleStudent = "sensei";

    public function render()
    {
        $user = Auth::user();

        return view('livewire.form-profile-edit',[
            'user' => $user,
        ]);
    }

    public function mount()
    {
        $user = Auth::user();

        $this->role = $user->role;
        

        if($user->role == "administrador")
        {
            $this->admin = $user->superadmin;
            $admin = $user->superadmin;
            
            $this->name = $admin->name;
            $this->id_user = $admin->id;
        }elseif($user->role == "sensei")
        {
            $this->sensei = $user->sensei;
            $sensei = $user->sensei;
            
            $this->id_user = $sensei->id;

            $this->nameSensei = $sensei->name;
            $this->emailSensei = $user->email;
            $this->organizationSensei = $sensei->organization;
            $this->dateOfBirthSensei = $sensei->date_of_birth;
            $this->photoSensei = $sensei->photo;
        }elseif($user->role == "estudiante")
        {
            $this->student = $user->student;
            $student = $user->student;
            
            $this->id_user = $student->id;

            $this->nameStudent = $student->name;
            $this->emailStudent = $user->email;
            $this->organizationStudent = $student->organization;
            $this->dateOfBirthStudent = $student->date_of_birth;
            $this->photoStudent = $student->photo;
        }

        $this->email = $user->email;

    }

    public function updateUser()
    {
        $user = Auth::user();

        if($this->role == "administrador")
        {
            $this->validate([
                'name' => ['required', 'string', 'min:8'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'password' => ['nullable','confirmed', Rules\Password::defaults()],
            ]);
            
            if($this->password && $this->password_confirmation)
            {   
                User::where('id', $user->id)
                    ->update([
                        'email' => $this->email,
                        'password' => Hash::make($this->password)
                    ]);
            }else{
                User::where('id', $user->id)
                    ->update([
                        'email' => $this->email
                    ]);
            }

            SuperAdmin::find($this->id_user)
                ->update([
                    'name' => $this->name,
                ]);
            
            $this->message = 'Perfil Actualizado con Exito';
            $this->dispatch('open-modal-success', newValue: 'true');
        }
        elseif($this->role == "sensei")
        {
            $this->validate([
                'nameSensei' => ['required', 'string', 'min:8'],
                'emailSensei' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'password' => ['nullable', Rules\Password::defaults(), 'confirmed'],
                'organizationSensei' => ['required', 'string'],
                'dateOfBirthSensei' => ['required', 'date'],
            ]);

            if($this->password && $this->password_confirmation)
            {   
                User::where('id', $user->id)
                    ->update([
                        'email' => $this->emailSensei,
                        'password' => Hash::make($this->password)
                    ]);
            }else{
                User::where('id', $user->id)
                    ->update([
                        'email' => $this->emailSensei
                    ]);
            }

            $sensei = Sensei::find($this->id_user);

            $sensei->update([
                    'name' => $this->nameSensei,
                    'date_of_birth' => $this->dateOfBirthSensei,
                    'organization' => $this->organizationSensei,
                ]);

            if ($this->photoSensei instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                $originalExtension = $this->photoSensei->getClientOriginalExtension();
                $newFileName = 'sensei-photo-(N-'.$this->id_user.').'.$originalExtension;
                $imagePathRelativeToDisk = $this->photoSensei->storeAs('senseis', $newFileName, 'public');
            
                $sensei->photo = $imagePathRelativeToDisk;
                $sensei->save();
    
            
                $this->photoSenseiKey = rand(); // ✅ Para refrescar la imagen en la vista
            }
            
            $this->message = 'Perfil Actualizado con Exito';
            $this->dispatch('open-modal-success', newValue: 'true');
            
        }
        elseif($this->role == "estudiante")
        {
            $this->validate([
                'nameStudent' => ['required', 'string', 'min:8'],
                'emailStudent' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
                'password' => ['nullable', Rules\Password::defaults(), 'confirmed'],
                'organizationStudent' => ['required', 'string'],
                'dateOfBirthStudent' => ['required', 'date'],
            ]);

            if($this->password && $this->password_confirmation)
            {   
                User::where('id', $user->id)
                    ->update([
                        'email' => $this->emailStudent,
                        'password' => Hash::make($this->password)
                    ]);
            }else{
                User::where('id', $user->id)
                    ->update([
                        'email' => $this->emailStudent
                    ]);
            }

            $student = Student::find($this->id_user);

            $student->update([
                    'name' => $this->nameStudent,
                    'date_of_birth' => $this->dateOfBirthStudent,
                    'organization' => $this->organizationStudent,
                ]);

            if ($this->photoStudent instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                $originalExtension = $this->photoStudent->getClientOriginalExtension();
                $newFileName = 'student-photo-(N-'.$this->id_user.').'.$originalExtension;
                $imagePathRelativeToDisk = $this->photoStudent->storeAs('students', $newFileName, 'public');
            
                $student->photo = $imagePathRelativeToDisk;
                $student->save();
    
            
                $this->photoStudentKey = rand(); // ✅ Para refrescar la imagen en la vista
            }
            
            $this->message = 'Perfil Actualizado con Exito';
            $this->dispatch('open-modal-success', newValue: 'true');
        }

        $this->reset('password', 'password_confirmation');
    }

    public function removeUser(){
        $user = Auth::user();

        User::find($user->id)->delete();

        Auth::logout(); // Cierra la sesión del usuario
        session()->invalidate(); // Invalida la sesión para mayor seguridad
        session()->regenerateToken(); // Regenera el token CSRF para evitar problemas de seguridad

        return redirect('/'); // Redirige a la página de inicio

    }

    public function removephotoSensei()
    {
        $this->photoSensei = '';
    }

    public function removephotoStudent()
    {
        $this->photoStudent = '';
    }

}
