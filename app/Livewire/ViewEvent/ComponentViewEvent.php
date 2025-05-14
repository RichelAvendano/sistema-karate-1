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

class ComponentViewEvent extends Component
{
    use WithFileUploads, WithPagination;

    public $name='', $description='', $location='', $eventType, $maxDojo,$maxSensei, $maxStudent, $participant_type = [],  $nameEdit='', $descriptionEdit='', $locationEdit='', $eventTypeEdit, $maxDojoEdit,$maxSenseiEdit, $maxStudentEdit, $participant_typeEdit = [], $id_selected, $modal, $successMessage = false, $cardDojos = true, $tableDojos = false;

    public  $message, $destroyMessage = false, $changeTable = false, $closeAnimation = false, $validateLabel = false, $photoModal = false, $saveModal = false, $closeAnimationSave = false;

    public $selectedValue = null,$selectedLabel = 'Selecciona un dojo',$selectedIcon = '', $search = '', $sortBy = 'created_at', $sortDirection = 'desc', $id_event;

    public $senseiCount, $senseiMaxCount, $dojoMaxCount, $studentMaxCount, $dojoCount, $studentCount, $user;

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
        [
            'value' => 'event_type',
            'title' => 'Tipo de Evento',
            'icon' => 'fa-solid fa-list'
        ],
    ];

    public $selectedValueEventType, $selectedValueEventTypeEdit, $optionsEventType = [ [ 'value' => 'competencia', ], [ 'value' => 'seminario', ], [ 'value' => 'entrenamiento', ], [ 'value' => 'social', ], [ 'value' => 'otro', ]];

    public $startTime, $endTime,$startTimeEdit, $endTimeEdit, $showEndTime= false, $errorMessage;

    protected $rules = [
        'startTime' => 'required|date_format:H:i',
        'endTime' => 'required|date_format:H:i|after:startTime'
    ];

    public function render()
    {
        $events = Event::query()
            ->withCount(['dojo', 'sensei', 'student'])
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where($this->selectedValue, 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(2, ['*'], 'eventos-page');

        return view('livewire.view-event.component-view-event', [
            'events' => $events
        ]);
    }

    public function mount()
    {
        $this->user = Auth::user();

        $this->selectedValue = 'Name';
        $this->selectedLabel = 'Name';
        $this->selectedIcon = 'fa-solid fa-vihara';
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

    public function selectOptionEventType($index)
    {
        $option = $this->optionsEventType[$index];
        $this->selectedValueEventType = $option['value'];
    }

    public function selectOptionEventTypeEdit($index)
    {
        $option = $this->optionsEventType[$index];
        $this->selectedValueEventTypeEdit = $option['value'];
    }

    public function selectOption($index)
    {
        $option = $this->options[$index];
        $this->selectedValue = $option['value'];
        $this->selectedLabel = $option['title'];
        $this->selectedIcon = $option['icon'];
    }

    public function saveEvent()
    {

        if(in_array('dojo', $this->participant_type))
        {
            $this->validate([
                'maxDojo' => 'required|integer|min:1',
            ]);
        }
        if(in_array('sensei', $this->participant_type))
        {
            $this->validate([
                'maxSensei' => 'required|integer|min:1',
            ]);
        }
        if(in_array('student', $this->participant_type))
        {
            $this->validate([
                'maxStudent' => 'required|integer|min:1',
            ]);
        }

        
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'selectedValueEventType' => 'required|string|max:255',
            'startTime' => 'required|date_format:Y-m-d\TH:i',
            'endTime' => 'required|date_format:Y-m-d\TH:i|after:startTime',
            'participant_type' => 'required|array',
            'participant_type.*' => 'in:dojo,student,sensei',
        ]);

        $this->startTime = \Carbon\Carbon::parse($this->startTime)->format('Y-m-d H:i:s');
        $this->endTime = \Carbon\Carbon::parse($this->endTime)->format('Y-m-d H:i:s');

        Event::create([
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'event_type' => $this->selectedValueEventType,
            'max_dojo' => $this->maxDojo,
            'max_sensei' => $this->maxSensei,
            'max_student' => $this->maxStudent,
            'start_date' => $this->startTime,
            'end_date' => $this->endTime,
            'participant_type' => json_encode($this->participant_type),
        ]);

        $this->reset([
            'name', 'description', 'location', 'selectedValueEventType', 'startTime', 'endTime', 'participant_type', 'maxDojo', 'maxSensei', 'maxStudent'
        ]);

        $this->message = 'Evento creado correctamente';
        $this->dispatch('open-modal-success', newValue: 'true');

    }
    
    public function editEventModal($id_event, $dojoCount, $senseiCount, $studentCount)
    {
        $this->resetErrorBag();


        $this->id_event = $id_event;
        $event = Event::find($id_event);

        $this->dojoCount = $dojoCount;
        $this->senseiCount = $senseiCount;
        $this->studentCount = $studentCount;

        $this->nameEdit = $event->name;
        $this->descriptionEdit = $event->description;
        $this->locationEdit = $event->location;
        $this->selectedValueEventTypeEdit = $event->event_type;
        $this->maxDojoEdit = $event->max_dojo;
        $this->maxSenseiEdit = $event->max_sensei;
        $this->maxStudentEdit = $event->max_student;


        $this->startTimeEdit = \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i');
        $this->endTimeEdit = \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i');
        $this->participant_typeEdit = json_decode($event->participant_type, true) ?? [];
    }

    public function editEvent()
    {

        if(in_array('dojo', $this->participant_typeEdit))
        {
            $this->validate([
                'maxDojoEdit' => 'required|integer|min:'.$this->dojoCount.'',
            ]);
        }
        if(in_array('sensei', $this->participant_typeEdit))
        {
            $this->validate([
                'maxSenseiEdit' => 'required|integer|min:'.$this->senseiCount.'',
            ]);
        }
        if(in_array('student', $this->participant_typeEdit))
        {
            $this->validate([
                'maxStudentEdit' => 'required|integer|min:'.$this->studentCount.'',
            ]);
        }
        
        $this->validate([
            'nameEdit' => 'required|string|max:255',
            'descriptionEdit' => 'required|string|max:255',
            'locationEdit' => 'required|string|max:255',
            'selectedValueEventTypeEdit' => 'required|string|max:255',
            'startTimeEdit' => 'required|date_format:Y-m-d\TH:i',
            'endTimeEdit' => 'required|date_format:Y-m-d\TH:i|after:startTimeEdit',
            'participant_typeEdit' => 'required|array',
            'participant_typeEdit.*' => 'in:dojo,student,sensei',
        ]);

        $this->startTimeEdit = \Carbon\Carbon::parse($this->startTimeEdit)->format('Y-m-d H:i:s');
        $this->endTimeEdit = \Carbon\Carbon::parse($this->endTimeEdit)->format('Y-m-d H:i:s');

        $event = Event::find($this->id_event);

        if (!in_array('dojo', $this->participant_typeEdit) && $event->dojo()->exists()) {
            $this->maxDojoEdit = null;
            $event->dojo()->detach();
        }
        
        if (!in_array('sensei', $this->participant_typeEdit) && $event->sensei()->exists()) {
            $this->maxSenseiEdit = null;
            $event->sensei()->detach();
        }
        
        if (!in_array('student', $this->participant_typeEdit) && $event->student()->exists()) {
            $this->maxStudentEdit = null;
            $event->student()->detach();
        }
        

        $event->update([
            'name' => $this->nameEdit,
            'description' => $this->descriptionEdit,
            'location' => $this->locationEdit,
            'event_type' => $this->selectedValueEventTypeEdit,
            'max_dojo' => $this->maxDojoEdit,
            'max_sensei' => $this->maxSenseiEdit,
            'max_student' => $this->maxStudentEdit,
            'start_date' => $this->startTimeEdit,
            'end_date' => $this->endTimeEdit,
            'participant_type' => json_encode($this->participant_typeEdit),
        ]);

        $this->message = 'Evento actualizado correctamente';
        $this->dispatch('open-modal-success', newValue: 'true');

    }

    public function deleteEventModal($id_event)
    {
        $this->id_event = $id_event;
        $this->message = "Se borrara el Evento y no se podra recuperar";
    }

    public function deleteEvent()
    {
        Event::find($this->id_event)->delete();
        $this->message = 'Evento borrado correctamente';
        $this->dispatch('open-modal-success', newValue: 'true');

    }
}
