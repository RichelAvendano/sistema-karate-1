<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Dojo;
use App\Models\Event;
use App\Models\Sensei;
use App\Models\Student;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $chartDataDojo = [], $chartDataSensei = [], $chartDataStudent = [], $chartDataDojoStudent = [], $chartDataEvent = [], $user;
    public $chartLabelDojo, $chartLabelSensei, $chartLabelStudent, $chartLabelDojoStudent, $chartLabelEvent;
    public $colors = ['#c72525', '#383737']; // activo , inactivo
    public $colorSensei = ['#3f7fe8', '#383737'];
    public $colorStudent = ['#318b17', '#383737'];
    public $colorsDojoStudent = [
        "#FAD2E1", // Rosa pastel
        "#B5EAD7", // Verde menta
        "#FFDAC1", // Melocotón suave
        "#383737", // Verde lima pastel
    ];

    public $colorEvent = [
        "#383737", // Rosa pastel
        "#70e0b8", // Verde menta
        "#d2b099", // Melocotón suave
    ];
    public $totalDojos = 0, $totalSenseis = 0, $totalStudents = 0;
    public $sortBy = 'created_at', $sortDirection = 'desc' ;

    public function mount()
    {
        $user = Auth::user();

        $activeCount = Dojo::has('sensei')->count();

        if($user->role == "administrador")
        {
            $inactiveCount = Dojo::doesntHave('sensei')->count();
        
            $this->totalDojos = $activeCount + $inactiveCount;
            
            $this->chartDataDojo = [$activeCount, $inactiveCount];

            $this->chartLabelDojo = [
                "Dojos Activos: $activeCount",
                "Dojos Inactivos: $inactiveCount"
            ];

        }else{
            $this->totalDojos = $activeCount;

            $this->chartDataDojo = [$activeCount];

            $this->chartLabelDojo = [
                "Dojos Registrados: $activeCount",
            ];
        }
        
        $activeCount = Sensei::where("status", "activo")->count();
        if($user->role == "administrador")
        {
            $inactiveCount = Sensei::where("status", "inactivo")->count();
            $this->totalSenseis = $activeCount + $inactiveCount;
            
            $this->chartDataSensei = [$activeCount, $inactiveCount];
            $this->chartLabelSensei = [
                "Senseis Activos: $activeCount",
                "Senseis Inactivos: $inactiveCount"
            ];
        }else{
            $this->totalSenseis = $activeCount;
            
            $this->chartDataSensei = [$activeCount];
            $this->chartLabelSensei = [
                "Senseis Registrados: $activeCount",
            ];

        }
        
        $activeCount = Student::where("status", "activo")->count();
        if($user->role == "administrador")
        {
            $inactiveCount = Student::where("status", "inactivo")->count();
            $this->totalStudents = $activeCount + $inactiveCount;
            
            $this->chartDataStudent = [$activeCount, $inactiveCount];
            $this->chartLabelStudent = [
                "Atletas Activos: $activeCount",
                "Atletas Inactivos: $inactiveCount"
            ];
        }else{
            $this->totalStudents = $activeCount;
            
            $this->chartDataStudent = [$activeCount];
            $this->chartLabelStudent = [
                "Atletas Registrados: $activeCount",
            ];
        }
        

        $dojos = Dojo::withCount('student')
            ->orderBy('student_count', 'desc') // Ordenar por cantidad de estudiantes
            ->get();

        // Obtener los primeros X dojos con más estudiantes (puedes cambiar el número)
        $topDojos = $dojos->take(3);

        // Calcular el total restante de estudiantes
        $otrosCount = $dojos->slice(3)->sum('student_count');

        // Guardar los datos en un array estructurado para el gráfico
        $this->chartDataDojoStudent = $topDojos->pluck('student_count')->toArray(); // Números de alumnos por dojo
        $this->chartDataDojoStudent[] = $otrosCount; // Agregar el total restante como "Otros"

        $this->chartLabelDojoStudent = $topDojos->pluck('name')->toArray(); // Nombres de los dojos
        $this->chartLabelDojoStudent[] = "Otros"; // Etiqueta final con los alumnos restantes

        $fechaActual = now(); // Obtener la fecha actual

        // Contar los eventos según su estado
        $eventosPasados = Event::where('end_date', '<', $fechaActual)->count();
        $eventosActuales = Event::where('start_date', '<=', $fechaActual)
                                ->where('end_date', '>=', $fechaActual)
                                ->count();
        $eventosProximos = Event::where('start_date', '>', $fechaActual)->count();

        // Guardar los valores en el array de datos
        $this->chartDataEvent = [$eventosPasados, $eventosActuales, $eventosProximos];

        $this->chartLabelEvent = [
            "Eventos Pasados: $eventosPasados",
            "Eventos en Curso: $eventosActuales",
            "Eventos Próximos: $eventosProximos"
        ];
    }

    public function render()
    {
        $user = Auth::user();
        $this->user = $user;

        $fechaActual = now();

        $eventCount = Event::count();
        $events = Event::query()
            ->withCount(['dojo', 'sensei', 'student'])
            ->get();

        $eventsUpcoming = Event::where('start_date', '>', $fechaActual)
                                ->withCount(['dojo', 'sensei', 'student'])
                                ->get();

        $eventsUpcomingCount = Event::where('start_date', '>', $fechaActual)
                                ->count();

        $eventsCurrent = Event::where('start_date', '<=', $fechaActual)
                                ->where('end_date', '>=', $fechaActual)
                                ->withCount(['dojo', 'sensei', 'student'])
                                ->get();

        $eventsCurrentCount = Event::where('start_date', '<=', $fechaActual)
                                ->where('end_date', '>=', $fechaActual)
                                ->count();
        

        $dojos = Dojo::select('*', DB::raw("'Dojo' as type"))->latest()->take(10)->get();
        $eventos = Event::select('*', DB::raw("'Eventos' as type"))->latest()->take(10)->get();

        $senseis = Sensei::with('user')
            ->whereHas('user')
            ->get()
            ->sortByDesc(fn($sensei) => $sensei->user->created_at)
            ->take(10);

        $students = Student::with('user')
            ->whereHas('user')
            ->get()
            ->sortByDesc(fn($student) => $student->user->created_at)
            ->take(10);

        $superadmins = SuperAdmin::with('user')
            ->whereHas('user')
            ->get()
            ->sortByDesc(fn($superadmin) => $superadmin->user->created_at)
            ->take(10);

        // **Fusionamos todo en una colección ordenada por fecha**
        $recents = collect()
            ->merge($dojos)
            ->merge($eventos)
            ->merge($senseis)
            ->merge($students)
            ->merge($superadmins)
            ->sortByDesc(fn($registro) => isset($registro->user) ? $registro->user->created_at : $registro->created_at)
            ->take(10);

        return view('livewire.dashboard.dashboard',[
            'events' => $events,
            'recents' => $recents,
            'eventCount' => $eventCount,
            'eventsUpcoming' => $eventsUpcoming,
            'eventsUpcomingCount' => $eventsUpcomingCount,
            'eventsCurrent' => $eventsCurrent,
            'eventsCurrentCount' => $eventsCurrentCount,
            'user' => $user
        ]);
    }

    public function sendSearchEventCurrent($eventOrder)
    {
        session()->flash('searchUser', $eventOrder);

        
        return redirect()->route('display-event');
    }

    public function sendSearchUser($searchUser, $role)
    {
        session()->flash('searchUser', $searchUser); // Guardar dato en sesión

        if($role == 'administrador')
        {
            return redirect()->route('view-admin');
        }elseif($role == 'sensei')
        {
            return redirect()->route('view-sensei');
        }elseif($role == 'estudiante')
        {
            return redirect()->route('view-student');
        }elseif($role == 'Eventos')
        {
            return redirect()->route('admin-event');
        }else{
            return redirect()->route('view-dojos');
        }
    }
    
    
}