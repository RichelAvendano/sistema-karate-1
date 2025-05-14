<?php

namespace App\Livewire\ViewEvent;

use App\Models\Dojo;
use App\Models\Event;
use App\Models\Schedule;
use App\Models\Sensei;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ComponentDisplayEvent extends Component
{   
    /* Event */
    use WithPagination;

    public $activeCradDojo = true, $activeCardSensei = false, $activeCardStudent = false;

    public $optionsSearchDojo = [
        [
            'value' => 'dojo',
            'title' => 'Nombre',
            'icon' => 'fa-solid fa-vihara'
        ],
        [
            'value' => 'location',
            'title' => 'Ubicacion',
            'icon' => 'fa-solid fa-location-dot'
        ],   
    ];

    public $filter = 'all', $buttonDefaultSearch; // Filtro predeterminado

    public function setFilter($type)
    {
        $this->filter = $type;
        $this->resetPage(); // Resetear paginación al cambiar el filtro
    }

    public function mount()
    {
        if(session('searchUser'))
        {
            $this->filter = session('searchUser');
            $this->buttonDefaultSearch = $this->filter;
        }
    }

    public function render()
    {
        $query = Event::query()
            ->with('dojo', 'sensei', 'student')
            ->withCount('sensei', 'student', 'dojo');

        $fechaActual = Carbon::now();

        // Aplicar filtros dinámicamente
        if ($this->filter === 'past') {
            $query->where('end_date', '<', $fechaActual);
        } elseif ($this->filter === 'current') {
            $query->where('start_date', '<=', $fechaActual)
                  ->where('end_date', '>=', $fechaActual);
        } elseif ($this->filter === 'upcoming') {
            $query->where('start_date', '>', $fechaActual);
        }

        $events = $query->paginate(3); // Paginación con 5 eventos por página
        $user = Auth::user();
        return view('livewire.view-event.component-display-event', [
            'events' => $events,
            'user' => $user,
        ]);
    }

    
}
