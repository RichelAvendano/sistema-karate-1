<?php

namespace App\Livewire\ViewEvent;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;
use App\Models\Dojo;

class SearchDojo extends Component
{
    use WithPagination;

    public $searchDojo = '', $eventId, $selectedValueSearchDojo, $selectedIconSearchDojo, $selectedLabelSearchDojo;

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

    public function mount($eventId)
    {
        $this->selectedValueSearchDojo = 'name';
        $this->selectedLabelSearchDojo = 'Nombre';
        $this->selectedIconSearchDojo = 'fa-solid fa-vihara';

        $this->eventId = $eventId;
    }

    public function render()
    {
        
        // 🔹 Filtrar dojos según el evento específico
        $dojos = Dojo::query()
            ->whereHas('event', function ($query) {
                $query->where('events.id', $this->eventId);
            })
            ->where($this->selectedValueSearchDojo, 'like', '%' . $this->searchDojo . '%')
            ->paginate(4, ['*'], 'dojos-page');

        return view('livewire.view-event.search-dojo', compact('dojos'));
    }

    public function selectOptionDojo($index)
    {

        $option = $this->optionsSearchDojo[$index];

        $this->selectedValueSearchDojo = $option['value'];
        $this->selectedLabelSearchDojo = $option['title'];
        $this->selectedIconSearchDojo = $option['icon'];      
    }
}
