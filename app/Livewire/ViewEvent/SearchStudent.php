<?php

namespace App\Livewire\ViewEvent;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class SearchStudent extends Component
{
    use WithPagination;

    public $searchStudent = '', $eventId, $selectedValueSearchStudent, $selectedIconSearchStudent, $selectedLabelSearchStudent;

    public $optionsSearchStudent = [
        [
            'value' => 'name',
            'title' => 'Nombre',
            'icon' => 'fa-solid fa-user-graduate'
        ],
        [
            'value' => 'kyu',
            'title' => 'kyu',
            'icon' => 'fa-solid fa-ribbon'
        ],   
    ];

    public function mount($eventId)
    {
        $this->selectedValueSearchStudent = 'name';
        $this->selectedLabelSearchStudent = 'Nombre';
        $this->selectedIconSearchStudent = 'fa-solid fa-user-graduate';

        $this->eventId = $eventId;
    }

    public function render()
    {
       // 🔹 Filtrar dojos según el evento específico
       $students = Student::query()
       ->with('sensei')
       ->whereHas('event', function ($query) {
           $query->where('events.id', $this->eventId);
       })
       ->where($this->selectedValueSearchStudent, 'like', '%' . $this->searchStudent . '%')
       ->paginate(4, ['*'], 'students-page');

        return view('livewire.view-event.search-student', compact('students'));
    }

    public function selectOptionStudent($index)
    {

        $option = $this->optionsSearchStudent[$index];

        $this->selectedValueSearchStudent = $option['value'];
        $this->selectedLabelSearchStudent = $option['title'];
        $this->selectedIconSearchStudent = $option['icon'];      
    }
    
}
