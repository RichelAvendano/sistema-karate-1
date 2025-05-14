<?php

namespace App\Livewire\Dojos;

use App\Models\Dojo;
use App\Models\Schedule;
use App\Models\Sensei;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On; // ¡Importa este atributo!
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ComponentViewDojos extends Component
{   
    use WithPagination;
    use WithFileUploads;

    public $selectedValue = null,$selectedLabel = 'Selecciona un dojo',$selectedIcon = '', $search = '', $sortBy = 'dojos.id', $sortDirection = 'asc', $successMessage, $message;

    public $id_sensei,$id_dojo, $id_dojo_sensei,$id_schedule, $statusSensei = false, $changeTable = false, $id_student, $statusModalConfirm;

    public $selectedValueSearchStudent, $selectedIconSearchStudent, $selectedLabelSearchStudent, $searchStudent = '', $sortByStudent = 'name', $sortDirectionStudent = 'desc', $studentsInactiveSelected = true, $selectedValueSearchSensei, $selectedIconSearchSensei, $selectedLabelSearchSensei, $searchSensei = '', $sortBySensei = 'name', $sortDirectionSensei = 'desc', $senseisInactiveSelected = true;

    public $startTime;
    public $endTime;
    public $showEndTime = false;
    public $errorMessage = '';

    protected $rules = [
        'startTime' => 'required|date_format:H:i',
        'endTime' => 'required|date_format:H:i|after:startTime'
    ];

    public $options = [
        [
            'value' => 'dojo',
            'title' => 'Nombre del Dojo',
            'sort' => 'dojos.name',
            'icon' => 'fa-solid fa-vihara'
        ],
        [
            'value' => 'sensei',
            'title' => 'Nombre del Sensei',
            'sort' => 'sensei.name',
            'icon' => 'fa-solid fa-user-ninja'
        ],
        [
            'value' => 'student',
            'title' => 'Nombre del Estudiante',
            'sort' => 'student.name',
            'icon' => 'fa-solid fa-user-graduate'
        ],
    ];

    public $optionsSearchStudent = [
        [
            'value' => 'name',
            'title' => 'Nombre',
            'icon' => 'fa-solid fa-user-ninja'
        ],
        [
            'value' => 'kyu',
            'title' => 'Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],   
    ];

    public $optionsSearchSensei = [
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

    public $selectedValueDay,$description, $optionsDay = [ [ 'value' => 'Lunes', ], [ 'value' => 'Martes', ], [ 'value' => 'Miercoles', ], [ 'value' => 'Jueves', ], [ 'value' => 'Viernes', ], [ 'value' => 'Sabado', ], [ 'value' => 'Domingo', ], ];

    public $selectedValueDayEdit,$descriptionEdit,$endTimeEdit,$startTimeEdit ;

    public function render()
    {
        $studentsInactive = Student::query()
            ->where('sensei_id','=',null)
            ->when($this->searchStudent, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValueSearchStudent, 'like', '%'.$this->searchStudent.'%');
                    
                });
            })
            ->orderBy($this->sortByStudent, $this->sortDirectionStudent)
            ->paginate(2, ['*'], 'estudiantes-inactivos-page');

        $senseisInactive = Sensei::query()
            ->where('dojo_id','=',null)
            ->when($this->searchSensei, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValueSearchSensei, 'like', '%'.$this->searchSensei.'%');
                    
                });
            })
            ->orderBy($this->sortBySensei, $this->sortDirectionSensei)
            ->paginate(2, ['*'], 'senseis-inactivos-page');      
            
        $user = Auth::user();

        if($user->role == "administrador")
        {
            $dojos = Dojo::query()
            ->with('schedule')
            ->with(['sensei.student'])
            ->withCount(['student', 'event']) // ✅ Cargar Sensei y sus estudiantes correctamente
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    if ($this->selectedValue == "dojo") {
                        $q->where('name', 'like', '%'.$this->search.'%'); // ✅ Buscar en Dojo
                    } elseif ($this->selectedValue == "sensei") {
                        $q->orWhereHas('sensei', function ($q) {
                            $q->where('name', 'like', '%'.$this->search.'%'); // ✅ Buscar en Sensei
                        });
                    } elseif ($this->selectedValue == "student") {
                        $q->orWhereHas('sensei.student', function ($q) {
                            $q->where('name', 'like', '%'.$this->search.'%'); // ✅ Buscar en Students
                        });
                    }
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(2, ['*'], 'dojos-page');
        }
        elseif($user->role == "sensei"){
            $dojos = Dojo::query()
                        ->where('id', $user->sensei->dojo_id)
                        ->with('schedule')
                        ->with(['sensei.student'])
                        ->withCount(['student', 'event'])
                        ->paginate(1, ['*'], 'dojos-page');
        }
        else{
            $dojos = Dojo::query()
                        ->where('id', $user->student->dojo_id)
                        ->with('schedule')
                        ->with(['sensei.student'])
                        ->withCount(['student', 'event'])
                        ->paginate(1, ['*'], 'dojos-page');
        } 
        
            
        $daysOfWeek = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];

        return view('livewire.dojos.component-view-dojos', [
            'dojos' => $dojos,
            'studentsInactive' => $studentsInactive,
            'senseisInactive' => $senseisInactive,
            'daysOfWeek' => $daysOfWeek,
            'user' => $user
        ]);

        
    }

    public function mount()
    {
        $this->selectedValueSearchStudent = 'name';
        $this->selectedLabelSearchStudent = 'Nombre';
        $this->selectedIconSearchStudent = 'fa-solid fa-user-ninja';

        $this->selectedValueSearchSensei = 'name';
        $this->selectedLabelSearchSensei = 'Nombre';
        $this->selectedIconSearchSensei = 'fa-solid fa-user-ninja';


        if(session('searchUser'))
        {
            $this->search = session('searchUser');
        }
        $this->selectedValue = $this->options[0]['value'];
        $this->selectedLabel = $this->options[0]['title'];
        $this->sortBy = $this->options[0]['sort'];
        $this->selectedIcon = $this->options[0]['icon'];
    }

    public function selectOption($index)
    {
        $option = $this->options[$index];
        $this->selectedValue = $option['value'];
        $this->selectedLabel = $option['title'];
        $this->selectedIcon = $option['icon'];
    }

    public function selectOptionStudent($index)
    {

        $option = $this->optionsSearchStudent[$index];

        $this->selectedValueSearchStudent = $option['value'];
        $this->selectedLabelSearchStudent = $option['title'];
        $this->selectedIconSearchStudent = $option['icon'];      
    }

    public function selectOptionSensei($index)
    {

        $option = $this->optionsSearchSensei[$index];

        $this->selectedValueSearchSensei = $option['value'];
        $this->selectedLabelSearchSensei = $option['title'];
        $this->selectedIconSearchSensei = $option['icon'];      
    }

    public function selectOptionDay($index)
    {
        $option = $this->optionsDay[$index];
        $this->selectedValueDay = $option['value'];
    }

    public function studentsSensei($id_dojo,$id_sensei, $statusSensei)
    {
        $this->id_dojo = $id_dojo;
        $this->id_sensei = $id_sensei;
        $this->statusSensei = $statusSensei;

    }

    public function senseisDojo($id_dojo,$id_dojo_sensei, $status)
    {
        $this->id_dojo = $id_dojo;
        $this->id_dojo_sensei = $id_dojo_sensei;
        $this->statusModalConfirm = $status;

    }

    public function modalConfirmStudent($status, $idStudent)
    {
        $this->id_student = $idStudent;
        $this->statusModalConfirm = $status;
    }

    public function modalConfirmSensei($id_sensei)
    {
        $this->id_sensei = $id_sensei;
    }

    public function addStudentSensei()
    {
        Student::find($this->id_student)->update([
            'sensei_id' => $this->id_sensei,
            'dojo_id' => $this->id_dojo,
            'status' => 'activo',
        ]);
    }

    public function removeStudentSensei()
    {
        Student::find($this->id_student)->update([
            'sensei_id' => null,
            'dojo_id' => null,
            'status' => 'inactivo',
        ]);
    }

    public function addDojoSensei()
    {
        Sensei::find($this->id_sensei)->update([
            'dojo_id' => $this->id_dojo,
            'status' => 'activo',
        ]);


        if($this->id_dojo_sensei){
            Sensei::find($this->id_dojo_sensei)->update([
                'dojo_id' => null,
                'status' => 'inactivo'
            ]);

            Student::where('sensei_id', '=', $this->id_dojo_sensei)->update([
                'sensei_id' => $this->id_sensei,
            ]);
        }  
    }


    public function updatedStartTime($value)
    {
        if ($value) {
            $this->showEndTime = true;
            $this->errorMessage = '';
            $this->dispatch('time-changed', [
                'start' => $this->startTime ? $this->startTime . ':00' : null,
                'end' => $this->endTime ? $this->endTime . ':00' : null
            ]);
        }
    }

    public function updatedEndTime($value)
    {
        if ($this->startTime && $this->endTime) {
            $this->validateOnly('endTime');
            $this->dispatch('time-changed', [
                'start' => $this->startTime ? $this->startTime . ':00' : null,
                'end' => $this->endTime ? $this->endTime . ':00' : null
            ]);
        }
    }

    public function formatAMPM($time)
    {
        if (!$time) return '--:-- --';
        
        $timeParts = explode(':', $time);
        $hours = (int)$timeParts[0];
        $minutes = $timeParts[1] ?? '00';
        
        $ampm = $hours >= 12 ? 'PM' : 'AM';
        $hours = $hours % 12;
        $hours = $hours ? $hours : 12; // 0 horas = 12 AM
        
        return sprintf('%d:%s %s', $hours, $minutes, $ampm);
    }

    public function saveScheduleModal($id_dojo)
    {
        $this->reset([
            'startTime',
            'endTime',
            'description',
            'selectedValueDay',
            'showEndTime',
            'errorMessage'
        ]);
        $this->id_dojo = $id_dojo;
    }


    public function saveSchedule()
    {
        // Validación básica de los campos
        $this->validate([
            'startTime' => 'required|date_format:H:i',
            'endTime' => 'required|date_format:H:i|after:startTime',
            'description' => 'required|string|max:255',
            'selectedValueDay' => 'required|string|max:255',
        ]);

        // Consulta para comprobar si ya existe un horario que se solape
        $overlap = Schedule::where('dojo_id', $this->id_dojo)
            ->where('day', $this->selectedValueDay)
            ->where(function ($query) {
                $query->where('start_time', '<', $this->endTime)
                    ->where('end_time', '>', $this->startTime);
            })->exists();

        // Si ya hay un horario que se superpone, se agrega un error y se detiene el proceso.
        if ($overlap) {
            $this->addError('endTime', 'Ya hay un horario asignado para ese rango de hora.');
            return;
        }

        // Si todo está correcto, se crea el horario.
        Schedule::create([
            'dojo_id'    => $this->id_dojo,
            'start_time' => $this->startTime,
            'end_time'   => $this->endTime,
            'class_type' => $this->description,
            'day'        => $this->selectedValueDay,
        ]);

        $this->message = 'Horario agregado con Exito';
        $this->dispatch('open-modal-success', newValue: 'true');
        $this->dispatch('close-modal', newValue: 'false');

    }

    public function editModalSchedule($id_schedule, $id_dojo)
    {
        $this->id_schedule = $id_schedule;
        $this->id_dojo = $id_dojo;
        $schedule = Schedule::find($id_schedule);
        $this->startTimeEdit = $schedule->start_time;
        $this->startTimeEdit = Carbon::parse($this->startTimeEdit)->format('H:i');

        $this->endTimeEdit = $schedule->end_time;
        $this->endTimeEdit = Carbon::parse($this->endTimeEdit)->format('H:i');

        $this->descriptionEdit = $schedule->class_type;
        $this->selectedValueDay = $schedule->day;
    }

    public function editSchedule()
    {
        // Validación de los campos de edición
        $this->validate([
            'startTimeEdit'    => 'required|date_format:H:i',
            'endTimeEdit'      => 'required|date_format:H:i|after:startTimeEdit',
            'descriptionEdit'  => 'required|string|max:255',
            'selectedValueDay' => 'required|string|max:255',
        ]);

        // Recupera el horario que se va a editar
        $schedule = Schedule::find($this->id_schedule);
        if (!$schedule) {
            $this->addError('schedule', 'El horario a actualizar no existe.');
            return;
        }

        // Normaliza los valores de hora.
        // Si el valor ya viene con segundos (ej. "13:00:00"), tomamos solo los primeros 5 caracteres ("13:00").
        $startInput = substr($this->startTimeEdit, 0, 5);
        $endInput   = substr($this->endTimeEdit, 0, 5);

        // Convertir a formato "H:i:s" para que coincida con lo almacenado en la BD.
        $newStart = \Carbon\Carbon::createFromFormat('H:i', $startInput)->format('H:i:s');
        $newEnd   = \Carbon\Carbon::createFromFormat('H:i', $endInput)->format('H:i:s');

        // Normaliza el día (quita espacios y conviértelo a minúsculas o estandariza según convenga)
        $day = $this->selectedValueDay;

        // Consulta para comprobar solapamientos, excluyendo el horario que estamos editando.
        // La condición de solapamiento:
        //   Un horario existente [exStart, exEnd] solapa con el nuevo [newStart, newEnd]
        //   si exStart < newEnd  Y exEnd > newStart.

        $overlap = Schedule::where('dojo_id', $this->id_dojo)
            ->where('id', '<>', $this->id_schedule)
            ->where('day', $day)
            ->where(function ($query) use ($newStart, $newEnd) {
                $query->where('start_time', '<', $newEnd)
                    ->where('end_time', '>', $newStart);
            })->exists();

        if ($overlap) {
            $this->addError('endTimeEdit', 'Ya hay un horario asignado para ese rango de hora.');
            return;
        } 

        // Actualiza el horario con los valores normalizados
        $schedule->update([
            'start_time' => $newStart,
            'end_time'   => $newEnd,
            'class_type' => $this->descriptionEdit,
            'day'        => $day,
        ]);

        $this->message = 'Horario actualizado correctamente';
        $this->dispatch('open-modal-success', newValue: 'true');
        $this->dispatch('close-modal', newValue: 'false');
    }

    public function removeScheduleModal($status, $id_schedule)
    {
        $this->id_schedule = $id_schedule;
        $this->statusModalConfirm = $status;
    }

    

    public function removeSchedule()
    {
        $schedule = Schedule::find($this->id_schedule);
        if ($schedule) {
            $schedule->delete();
            $this->successMessage = true;
            $this->message = 'Horario eliminado correctamente';
        } else {
            $this->addError('schedule', 'El horario a eliminar no existe.');
        }
    }

    public function clearSuccessMessage()
    {
        $this->dispatch('closeSuccess');
        
    }
    //
    #[On('closeSuccess')]
    public function closeSuccess()
    {
        sleep(0.7);
        $this->successMessage = false;
    }

    public function kyuStudentModal($status, $id_student)
    {
        $this->statusModalConfirm = $status;
        $this->id_student = $id_student;
    }

    public function upKyuStudent()
    {
        $student = Student::find($this->id_student);

        if (!$student || !$student->kyu) {
            return; // Evitar errores si el estudiante no existe o no tiene kyu
        }
        // Extraer el número del kyu actual
        preg_match('/(\d+)/', $student->kyu, $matches);

        if (!isset($matches[1])) {
            return; // Si no se encuentra número, no hacer cambios
        }
        $kyuNumber = (int) $matches[1];

        // Evitar que suba si ya es 1er kyu (máximo nivel antes del cinturón negro)
        if ($kyuNumber <= 1) {
            return;
        }
        // Calcular el nuevo kyu
        $newKyuNumber = $kyuNumber - 1;
        // Definir el sufijo correcto para cada kyu
        $suffixes = [
            1 => 'er',
            2 => 'do',
            3 => 'er',
            4 => 'to',
            5 => 'to',
            6 => 'to',
            7 => 'mo',
            8 => 'vo',
            9 => 'no',
            10 => 'mo',
        ];

        // Asignar el nuevo kyu al estudiante
        $student->kyu = "{$newKyuNumber}{$suffixes[$newKyuNumber]} kyu";
        $student->save();

        $this->message = 'Kyu subido Exitosamente';
        $this->dispatch('open-modal-success', newValue: 'true');
    }

    public function downKyuStudent()
    {
        $student = Student::find($this->id_student);

        if (!$student || !$student->kyu) {
            return; // Evitar errores si el estudiante no existe o no tiene kyu
        }

        // Extraer el número del kyu actual
        preg_match('/(\d+)/', $student->kyu, $matches);

        if (!isset($matches[1])) {
            return; // Si no se encuentra número, no hacer cambios
        }

        $kyuNumber = (int) $matches[1];

        // Evitar que suba si ya es 10mo kyu (máximo nivel antes de cinturón negro)
        if ($kyuNumber >= 10) {
            return;
        }

        // Calcular el nuevo kyu
        $newKyuNumber = $kyuNumber + 1;

        // Definir el sufijo correcto para cada kyu
        $suffixes = [
            1 => 'er',
            2 => 'do',
            3 => 'er',
            4 => 'to',
            5 => 'to',
            6 => 'to',
            7 => 'mo',
            8 => 'vo',
            9 => 'no',
            10 => 'mo',
        ];

        // Asignar el nuevo kyu al estudiante
        $student->kyu = "{$newKyuNumber}{$suffixes[$newKyuNumber]} kyu";
        $student->save();

        $this->message = 'Kyu bajado Exitosamente';
        $this->dispatch('open-modal-success', newValue: 'true');
    }

    protected function messages()
    {
        return [
            'endTime.after' => 'La hora final debe ser mayor que la hora inicial',
            'startTime.required' => 'Debes seleccionar una hora de inicio',
            'endTime.required' => 'Debes seleccionar una hora de finalización',
        ];
    }
}
