<?php

namespace App\Livewire\ViewEvent;

use App\Models\Sensei;
use Livewire\Component;
use Livewire\WithPagination;

class SearchSensei extends Component
{
    use WithPagination;

    public $searchSensei = '', $eventId, $selectedValueSearchSensei, $selectedIconSearchSensei, $selectedLabelSearchSensei;

    public $optionsSearchSensei = [
        [
            'value' => 'name',
            'title' => 'Nombre',
            'icon' => 'fa-solid fa-user-ninja'
        ],
        [
            'value' => 'dan',
            'title' => 'Dan',
            'icon' => 'fa-solid fa-ribbon'
        ],   
    ];

    public function mount($eventId)
    {
        $this->selectedValueSearchSensei = 'name';
        $this->selectedLabelSearchSensei = 'Nombre';
        $this->selectedIconSearchSensei = 'fa-solid fa-user-ninja';

        $this->eventId = $eventId;
    }

    public function render()
    {
        // 🔹 Filtrar dojos según el evento específico
        $senseis = Sensei::query()
            ->with('dojo')
            ->whereHas('event', function ($query) {
                $query->where('events.id', $this->eventId);
            })
            ->where($this->selectedValueSearchSensei, 'like', '%' . $this->searchSensei . '%')
            ->paginate(4, ['*'], 'senseis-page');

        return view('livewire.view-event.search-sensei', compact('senseis'));
    }

    public function selectOptionSensei($index)
    {

        $option = $this->optionsSearchSensei[$index];

        $this->selectedValueSearchSensei = $option['value'];
        $this->selectedLabelSearchSensei = $option['title'];
        $this->selectedIconSearchSensei = $option['icon'];      
    }
    
}
