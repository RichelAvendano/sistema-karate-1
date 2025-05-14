<div>   
    <nav id="mainnav-container">
        <div id="mainnav">
            <div id="mainnav-menu-wrap">
                <div class="nano">
                    <div class="nano-content">

                        <!--Profile Widget-->
                        <!--================================-->
                        <div id="mainnav-profile" class="mainnav-profile">
                            <div class="profile-wrap text-center">
                                <div class="pad-btm">
                                    @if ($user->photo)
                                        <img class="img-circle img-md" src="{{ asset('storage/'.$user->photo)}}" alt="Profile Picture">
                                    @else
                                        <img class="img-circle img-md" src="{{ asset('image/profile-admin.png')}}" alt="Profile Picture">
                                    @endif
                                </div>
                                <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                    <span class="pull-right dropdown-toggle">
                                        <i class="dropdown-caret"></i>
                                    </span>
                                    <p class="mnp-name">{{$user->name}}</p>

                                    
                                    <span class="mnp-desc">{{ Auth::user()->email }}</span>
                                </a>
                            </div>
                            <div id="profile-nav" class="collapse list-group bg-trans">
                                <a href="{{route('profile.edit')}}" class="link-plus {{request()->routeIs('profile.edit') ? 'modern-header' : 'modern-header-desactive'}}" style="padding:10px 16px;margin: 6px 0; display:block; color: black">
                                        <i class="fa-solid fa-user"></i> Ver Perfil
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="link-plus list-group-item" style="cursor: pointer;color:black;background: linear-gradient(135deg, #bc212121, #47020200);border-radius: 50px;padding:10px 16px;margin: 6px 0;" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa-solid fa-lock"></i>
                                        {{ __('Cerrar Sesión') }}
                                    </a>
                                </form>      
                            </div>
                        </div>

                        <ul id="mainnav-menu" class="list-group">
                
                            <!--Category name-->
                            <li class="list-header">Navigation</li>
                
                            <!--Menu list item-->
                            <li class="{{request()->routeIs('dashboard') ? 'modern-header' : 'modern-header-desactive'}}">
                                <a href="{{route('dashboard')}}" style="cursor: pointer;" >
                                    <i class="fa-solid fa-table-columns"></i>
                                    <span class="menu-title">Panel</span>
                                </a>
                            </li>
                            @if(Auth::user()->role == "administrador")
                            <li class="{{request()->routeIs(['super-admin','view-admin','view-sensei', 'view-student']) ? 'modern-header modern-header-select' : 'modern-header-desactive'}}">
                                <a href="#">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <span class="menu-title">Administrador</span>
                                    <i class="arrow"></i>
                                </a>
                                
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li class="{{request()->routeIs('super-admin') ? 'modern-header' : 'modern-header-desactive'}}"><a href="{{route('super-admin')}}" style="cursor: pointer;padding:7px 15px;" ><i class="fa-solid fa-users"></i>Crear Usuarios</a></li>
                                    <li class="{{request()->routeIs('view-admin') ? 'modern-header' : 'modern-header-desactive'}}"><a href="{{route('view-admin')}}" style="padding:7px 15px;"><i class="fa-solid fa-user-shield"></i></i>Ver Admins</a></li>
                                    <li class="{{request()->routeIs('view-sensei') ? 'modern-header' : 'modern-header-desactive'}}"><a href="{{route('view-sensei')}}" style="padding:7px 15px;"><i class="fa-solid fa-user-ninja"></i>Ver Senseis</a></li>	
                                    <li class="{{request()->routeIs('view-student') ? 'modern-header' : 'modern-header-desactive'}}"><a href="{{route('view-student')}}" style="padding:7px 15px;"><i class="fa-solid fa-user-graduate"></i>Ver Estudiantes</a></li>			
                                </ul>
                            </li>
                            @endif
                            
                            @if(Auth::user()->role == "administrador")
                            <li class="{{request()->routeIs(['dojos','view-dojos']) ? 'modern-header modern-header-select' : 'modern-header-desactive'}}">
                                
                                <a href="#">
                                    <i class="fa-solid fa-vihara"></i>
                                    <span class="menu-title">Dojos</span>
                                    <i class="arrow"></i>
                                </a>

                                <!--Submenu-->
                                <ul class="collapse">
                                    <li class="{{request()->routeIs('dojos') ? 'modern-header' : 'modern-header-desactive'}}">
                                        <a href="{{route('dojos')}}" style="padding:7px 15px;">
                                            <i class="fa-solid fa-plus" style="padding-right: 5px"></i>
                                            <span class="menu-title">Crear Dojos</span>
                                        </a>
                                    </li>

                                    <li class="{{request()->routeIs('view-dojos') ? 'modern-header' : 'modern-header-desactive'}}">
                                        <a href="{{route('view-dojos')}}" style="padding:7px 15px;">
                                            <i class="fa-solid fa-gears" style="padding-right: 5px"></i>
                                            <span class="menu-title">Gestionar Dojos</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @else
                                <li class="{{request()->routeIs('view-dojos') ? 'modern-header' : 'modern-header-desactive'}}">
                                    <a href="{{route('view-dojos')}}" style="cursor: pointer;" >
                                        <i class="fa-solid fa-vihara"></i>
                                        <span class="menu-title">Dojo</span>
                                    </a>
                                </li>
                            @endif

                            <li class="{{request()->routeIs(['view-event','admin-event', 'display-event']) ? 'modern-header modern-header-select' : 'modern-header-desactive'}}">
                                <a href="#">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <span class="menu-title">Eventos</span>
                                    <i class="arrow"></i>
                                </a>
                                <ul class="collapse">
                                    @if(Auth::user()->role == "administrador")
                                    <li class="{{request()->routeIs('view-event') ? 'modern-header' : 'modern-header-desactive'}}">
                                        <a href="{{route('view-event')}}" style="padding:7px 15px;">
                                            <i class="fa-solid fa-plus" style="padding-right: 5px"></i>
                                            <span class="menu-title">Crear Eventos</span>
                                        </a>
                                    </li>
                                    @endif

                                    @if(Auth::user()->role == "administrador" || Auth::user()->role == "sensei")
                                    <li class="{{request()->routeIs('admin-event') ? 'modern-header' : 'modern-header-desactive'}}">
                                        <a href="{{route('admin-event')}}" style="padding:7px 15px;">
                                            <i class="fa-solid fa-gears" style="padding-right: 5px"></i>
                                            <span class="menu-title">Gestionar Eventos</span>
                                        </a>
                                    </li>
                                    @endif

                                    <li class="{{request()->routeIs('display-event') ? 'modern-header' : 'modern-header-desactive'}}">
                                        <a href="{{route('display-event')}}" style="padding:7px 15px;">
                                            <i class="fa-solid fa-eye" style="padding-right: 5px"></i>
                                            <span class="menu-title">Ver Eventos</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>   
                        </ul>

                    </div>
                </div>
            </div>
            <!--================================-->
            <!--End menu-->

        </div>
    </nav>
</div>
