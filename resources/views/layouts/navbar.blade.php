<header id="navbar">
    <div id="navbar-container" class="boxed">

        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="{{route('dashboard')}}" class="navbar-brand">
                <img src="{{asset('image/logo-prueba.png')}}" alt="Nifty Logo" class="brand-icon">
                <div class="brand-title">
                    <span class="brand-text">ASO Karate</span>
                </div>
            </a>
        </div>
        <!--================================-->
        <!--End brand logo & name-->


        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content">
            <ul class="nav navbar-top-links">

                <!--Navigation toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#">
                        <i class="demo-pli-list-view"></i>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toogle button-->



                <!--Search-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                {{-- <li>
                    <div class="custom-search-form">
                        <label class="btn btn-trans" for="search-input" data-toggle="collapse" data-target="#nav-searchbox">
                            <i class="demo-pli-magnifi-glass"></i>
                        </label>
                        <form>
                            <div class="search-container collapse" id="nav-searchbox">
                                <input id="search-input" type="text" class="form-control" placeholder="Type for search...">
                            </div>
                        </form>
                    </div>
                </li> --}}
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Search-->

            </ul>
            <ul class="nav navbar-top-links">

                

                <!--User dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li id="dropdown-user" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                            <!--You can use an image instead of an icon.-->
                        @if(Auth::user()->role == "administrador")
                            <span class="ic-user pull-right">

                                <img src="{{asset('image/profile-admin.png')}}" alt="Nifty Logo" class="img-circle img-user media-object">

                            </span>
                            <div class="username hidden-xs" style="font-size: 15px">{{ Auth::user()->superadmin->name }}</div>

                        @elseif(Auth::user()->role == "estudiante")
                            <span class="ic-user pull-right">
                            
                                <img class="img-circle img-user media-object" src="{{ asset('storage/' . Auth::user()->student->photo) }}" alt="Profile Picture">
                            </span>
                            <div class="username hidden-xs" style="font-size: 15px">{{ Auth::user()->student->name }}</div>
                            
                        @else
                            <span class="ic-user pull-right">
                                <img class="img-circle img-user media-object" src="{{ asset('storage/' . Auth::user()->sensei->photo) }}" alt="Profile Picture">
                            </span>
                            <div class="username hidden-xs" style="font-size: 15px">{{ Auth::user()->sensei->name }}</div>
                        @endif
                    </a>


                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                        <ul class="head-list">
                            <a href="{{route('profile.edit')}}" class="link-plus {{request()->routeIs('profile.edit') ? 'modern-header' : 'modern-header-desactive'}}" style="padding:10px 16px;margin: 6px 10px; display:block; color: black">
                                <i class="fa-solid fa-user"></i> Ver Perfil
                            </a>
                            <li style="cursor: pointer;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a 
                                        onclick="event.preventDefault(); this.closest('form').submit();" class="link-plus modern-header-desactive" style="border-radius:16px; color:black; padding: 10px 16px;"><i class="fa-solid fa-lock" style="color:black"></i>
                                        {{ __('Cerrar Sesión') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End user dropdown-->
            </ul>
        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->

    </div>
</header>