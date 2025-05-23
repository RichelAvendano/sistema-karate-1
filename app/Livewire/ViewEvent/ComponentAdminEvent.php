<?php

namespace App\Livewire\ViewEvent;

use Livewire\Component;
use App\Models\Dojo;
use App\Models\Event;
use App\Models\Schedule;
use App\Models\Sensei;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On; // ¡Importa este atributo!
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ComponentAdminEvent extends Component
{
    use WithFileUploads, WithPagination;

    public  $message, $destroyMessage = false, $changeTable = false, $statusModalConfirm, $id_dojo,$id_sensei, $statusSensei, $id_student ;

    public $selectedValue = null,$selectedLabel = 'Selecciona un dojo',$selectedIcon = '', $search = '', $sortBy = 'name', $sortDirection = 'asc', $id_event;

    /* Dojos */
    public $selectedValueSearchDojo, $selectedIconSearchDojo, $selectedLabelSearchDojo, $searchDojo = '', $sortByDojo = 'name', $sortDirectionDojo = 'desc', $dojosActiveSelected = true, $dojosInactiveSelected = false;

    public $selectedValueSearchSensei, $selectedIconSearchSensei, $selectedLabelSearchSensei, $searchSensei = '', $sortBySensei = 'name', $sortDirectionSensei = 'desc', $senseisActiveSelected = true, $senseisInactiveSelected = false;

    public $selectedValueSearchStudent, $selectedIconSearchStudent, $selectedLabelSearchStudent, $searchStudent = '', $sortByStudent = 'name', $sortDirectionStudent = 'desc', $studentsActiveSelected = true, $studentsInactiveSelected = false;

    public $senseiCount, $senseiMaxCount, $dojoMaxCount, $studentMaxCount, $dojoCount, $studentCount;

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

    public $optionsSearchDojo = [
        [
            'value' => 'name',
            'title' => 'Nombre',
            'icon' => 'fa-solid fa-vihara'
        ],
        [
            'value' => 'location',
            'title' => 'Ubicacion',
            'icon' => 'fa-solid fa-location-dot'
        ],   
    ];

    public $optionsSearchSensei = [
        [
            'value' => 'name',
            'title' => 'Nombre',
            'icon' => 'fa-solid fa-user-ninja'
        ],
        [
            'value' => 'Dan',
            'title' => 'Dan',
            'icon' => 'fa-solid fa-ribbon'
        ],  
    ];

    public $optionsSearchStudent = [
        [
            'value' => 'name',
            'title' => 'Nombre',
            'icon' => 'fa-solid fa-user-graduate'
        ],
        [
            'value' => 'Kyu',
            'title' => 'Kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],  
    ];

    public function render()
    {
        $user = Auth::user();
        /* Query Dojos */
        $dojosActive = Dojo::query()
            ->with('sensei')
            ->with('student')
            ->whereHas('sensei')
            ->whereDoesntHave('event', function ($query) {
                $query->where('events.id', $this->id_event); // Excluye dojos con este evento
            })
            ->when($this->searchDojo, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValueSearchDojo, 'like', '%'.$this->searchDojo.'%');
                    
                });
            })
            ->orderBy($this->sortByDojo, $this->sortDirectionDojo)
            ->paginate(2, ['*'], 'studentsInactivePage');

        $dojosInactive = Dojo::query()
            ->with('sensei')
            ->with('student')
            ->whereHas('sensei')
            ->whereHas('event', function ($query) {
                $query->where('events.id', $this->id_event); // Excluye dojos con este evento
            })
            ->when($this->searchDojo, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValueSearchDojo, 'like', '%'.$this->searchDojo.'%');
                    
                });
            })
            ->orderBy($this->sortByDojo, $this->sortDirectionDojo)
            ->paginate(2, ['*'], 'studentsInactivePage');

        /* Query Senseis */

        $senseisActive = Sensei::query()
            ->with('dojo')
            ->with('student')
            ->whereDoesntHave('event', function ($query) {
                $query->where('events.id', $this->id_event); // Excluye dojos con este evento
            })
            ->withCount('event')
            ->when($this->searchSensei, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValueSearchSensei, 'like', '%'.$this->searchSensei.'%');
                    
                });
            })
            ->orderBy($this->sortBySensei, $this->sortDirectionSensei)
            ->paginate(2, ['*'], 'studentsInactivePage');

        $senseisInactive = Sensei::query()
            ->with('dojo')
            ->with('student')
            ->whereHas('event', function ($query) {
                $query->where('events.id', $this->id_event); // Excluye dojos con este evento
            })
            ->when($this->searchSensei, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValueSearchSensei, 'like', '%'.$this->searchSensei.'%');
                    
                });
            })
            ->orderBy($this->sortBySensei, $this->sortDirectionSensei)
            ->paginate(2, ['*'], 'studentsInactivePage');

        /* Query Senseis */
        $studentsQuery = Student::query()
            ->with(['dojo', 'sensei'])
            ->whereDoesntHave('event', function ($query) {
                $query->where('events.id', $this->id_event); // Excluye dojos con este evento
            })
            ->when($this->searchStudent, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValueSearchStudent, 'like', '%'.$this->searchStudent.'%');
                });
            })
            ->orderBy($this->sortByStudent, $this->sortDirectionStudent);

        // Agregar condición según el rol
        if ($user->role !== "administrador") {
            $studentsQuery->where('students.sensei_id', $user->sensei->id);
        }

        // Paginar la consulta
        $studentsActive = $studentsQuery->paginate(2, ['*'], 'studentsInactivePage');

       
        $studentsInactiveQuery = Student::query()
            ->with(['dojo', 'sensei']) // Cargar relaciones
            ->whereHas('event', function ($query) {
                $query->where('events.id', $this->id_event); // Filtrar solo dojos con este evento
            })
            ->when($this->searchStudent, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValueSearchStudent, 'like', '%' . $this->searchStudent . '%');
                });
            })
            ->orderBy($this->sortByStudent, $this->sortDirectionStudent);

        // Agregar condición según el rol
        if ($user->role !== "administrador") {
            $studentsInactiveQuery->where('students.sensei_id', $user->sensei->id);
        }

        // Paginar la consulta
        $studentsInactive = $studentsInactiveQuery->paginate(2, ['*'], 'studentsInactivePage');

        $events = Event::query()
            ->withCount(['dojo', 'sensei', 'student'])
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValue, 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(2, ['*'], 'eventos-page');

        return view('livewire.view-event.component-admin-event', [
            'events' => $events,
            'dojosActive' => $dojosActive,
            'dojosInactive' => $dojosInactive,
            'senseisActive' => $senseisActive,
            'senseisInactive' => $senseisInactive,
            'studentsActive' => $studentsActive,
            'studentsInactive' => $studentsInactive,
            'user' => $user,
        ]);
    }

    public function mount()
    {
        if(session('searchUser'))
        {
            $this->search = session('searchUser');
        }

        $this->selectedValue = 'Name';
        $this->selectedLabel = 'Nombre';
        $this->selectedIcon = 'fa-solid fa-vihara';

        $this->selectedValueSearchDojo = 'name';
        $this->selectedLabelSearchDojo = 'Nombre';
        $this->selectedIconSearchDojo = 'fa-solid fa-vihara';

        $this->selectedValueSearchSensei = 'name';
        $this->selectedLabelSearchSensei = 'Nombre';
        $this->selectedIconSearchSensei = 'fa-solid fa-user-ninja';

        $this->selectedValueSearchStudent = 'name';
        $this->selectedLabelSearchStudent = 'Nombre';
        $this->selectedIconSearchStudent = 'fa-solid fa-user-ninja';
    }

    public function selectOption($index)
    {
        $option = $this->options[$index];
        $this->selectedValue = $option['value'];
        $this->selectedLabel = $option['title'];
        $this->selectedIcon = $option['icon'];
    }

    public function selectOptionDojo($index)
    {

        $option = $this->optionsSearchDojo[$index];

        $this->selectedValueSearchDojo = $option['value'];
        $this->selectedLabelSearchDojo = $option['title'];
        $this->selectedIconSearchDojo = $option['icon'];      
    }

    public function selectOptionSensei($index)
    {
        $option = $this->optionsSearchSensei[$index];

        $this->selectedValueSearchSensei = $option['value'];
        $this->selectedLabelSearchSensei = $option['title'];
        $this->selectedIconSearchSensei = $option['icon'];      
    }

    public function selectOptionStudent($index)
    {
        $option = $this->optionsSearchStudent[$index];

        $this->selectedValueSearchStudent = $option['value'];
        $this->selectedLabelSearchStudent = $option['title'];
        $this->selectedIconSearchStudent = $option['icon'];      
    }

    public function dojosActive()
    {
        $this->dojosActiveSelected = true;
        $this->dojosInactiveSelected = false;
        $this->changeTable = true;
    }

    public function dojosInactive()
    {
        $this->dojosActiveSelected = false;
        $this->dojosInactiveSelected = true;
        $this->changeTable = true;
    }

    public function senseisActive()
    {
        $this->senseisActiveSelected = true;
        $this->senseisInactiveSelected = false;
        $this->changeTable = true;
    }

    public function senseisInactive()
    {
        $this->senseisActiveSelected = false;
        $this->senseisInactiveSelected = true;
        $this->changeTable = true;
    }

    public function studentsActive()
    {
        $this->studentsActiveSelected = true;
        $this->studentsInactiveSelected = false;
        $this->changeTable = true;
    }

    public function studentsInactive()
    {
        $this->studentsActiveSelected = false;
        $this->studentsInactiveSelected = true;
        $this->changeTable = true;
    }

    public function addDojo($id_event, $dojoCount, $dojoMaxCount, $id_dojo = null, $status = null)
    {
        $this->id_event = $id_event;
        $this->dojoCount = $dojoCount;
        $this->dojoMaxCount = $dojoMaxCount;

        if($id_dojo)
        {
            $this->id_dojo = $id_dojo;
            $this->statusModalConfirm = $status;
        }
    }

    public function addSensei($id_event,$senseiCount, $senseiMaxCount, $id_sensei = null, $status = null)
    {
        $this->id_event = $id_event;
        $this->senseiCount = $senseiCount;
        $this->senseiMaxCount = $senseiMaxCount;

        if($id_sensei)
        {
            $this->id_sensei = $id_sensei;
            $this->statusModalConfirm = $status;
        }
    }

    public function addStudent($id_event, $studentCount, $studentMaxCount)
    {
        $this->id_event = $id_event;
        $this->studentCount = $studentCount;
        $this->studentMaxCount = $studentMaxCount;
    }

    public function modalConfirmDojo($status, $id_dojo)
    {
        $this->id_dojo = $id_dojo;
        $this->statusModalConfirm = $status;
    }
    
    public function addEventDojo()
    {
        $dojo = Dojo::find($this->id_dojo);
        $event = Event::find($this->id_event);
        $this->dojoCount += 1;

        $dojo->event()->attach($event->id);

        $this->message = 'Dojo Agregado con exito al Evento';
        $this->dispatch('open-modal-success', newValue: 'true');
    }

    public function removeEventDojo()
    {
        $dojo = Dojo::find($this->id_dojo);
        $event = Event::find($this->id_event);
        $this->dojoCount -= 1;

        $dojo->event()->detach($event->id);

        $this->message = 'Dojo Eliminado con exito del Evento';
        $this->dispatch('open-modal-success', newValue: 'true');
    }

    public function modalConfirmSensei($status, $id_sensei)
    {
        $this->id_sensei = $id_sensei;
        $this->statusModalConfirm = $status;
    }

    public function addEventSensei()
    {
        $sensei = Sensei::find($this->id_sensei);
        $event = Event::find($this->id_event);
        $this->senseiCount += 1; 

        $sensei->event()->attach($event->id);

        $this->message = 'Sensei Agregado con exito al Evento';
        $this->dispatch('open-modal-success', newValue: 'true');
    }

    public function removeEventSensei()
    {
        $sensei = Sensei::find($this->id_sensei);
        $event = Event::find($this->id_event);
        $this->senseiCount -= 1; 

        $sensei->event()->detach($event->id);

        $this->message = 'sensei Eliminado con exito del Evento';
        $this->dispatch('open-modal-success', newValue: 'true');
    }

    public function modalConfirmStudent($status, $id_student)
    {
        $this->id_student = $id_student;
        $this->statusModalConfirm = $status;
    }

    public function addEventStudent()
    {
        $student = Student::find($this->id_student);
        $event = Event::find($this->id_event);
        $this->studentCount += 1;

        $student->event()->attach($event->id);

        $this->message = 'Estudiante Agregado con exito al Evento';
        $this->dispatch('open-modal-success', newValue: 'true');
    }

    public function removeEventStudent()
    {
        $student = Student::find($this->id_student);
        $event = Event::find($this->id_event);
        $this->studentCount -= 1;

        $student->event()->detach($event->id);

        $this->message = 'Estudiante Eliminado con exito del Evento';
        $this->dispatch('open-modal-success', newValue: 'true');
    }
   
}
