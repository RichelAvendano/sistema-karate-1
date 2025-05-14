<?php

namespace App\Livewire\Home;

use App\Models\Dojo;
use App\Models\Event;
use App\Models\Sensei;
use App\Models\Student;
use Livewire\Component;

class HomeLivewire extends Component
{
    public function render()
    {
        $dojosCount = Dojo::count();

        $senseisActive = Sensei::with('dojo')->count();

        $studentsCount = Student::count();

        $fechaActual = now(); // Obtener la fecha actual
        $eventosUpcoming = Event::where('start_date', '>', $fechaActual)->count();


        $dojos = Dojo::query()
            ->has('sensei')
            ->withCount('student')
            ->inRandomOrder()
            ->take(3)
            ->get();

        $senseis = Sensei::query()
            ->with('dojo')
            ->withCount('event')
            ->inRandomOrder()
            ->take(3)
            ->get();

        $students = Student::query()
            ->with('dojo')
            ->withCount('event')
            ->inRandomOrder()
            ->take(3)
            ->get();

        $fechaActual = now(); // Obtener la fecha actual
        $eventsUpcoming = Event::where('start_date', '>', $fechaActual)->get();

        $eventsCurrent = Event::where('start_date', '<=', $fechaActual)
                                ->where('end_date', '>=', $fechaActual)
                                ->get();

        return view('livewire.home.home-livewire',[
            'dojosCount' => $dojosCount,
            'senseisActive' => $senseisActive,
            'studentsCount' => $studentsCount,
            'eventosUpcoming' => $eventosUpcoming,
            'dojos' => $dojos,
            'senseis' => $senseis,
            'students' => $students,
            'eventsUpcoming' => $eventsUpcoming,
            'eventsCurrent' => $eventsCurrent
        ]);
    }
}
