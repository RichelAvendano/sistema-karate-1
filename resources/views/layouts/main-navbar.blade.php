

<nav id="mainnav-container">
    <div id="mainnav">


        <!--OPTIONAL : ADD YOUR LOGO TO THE NAVIGATION-->
        <!--It will only appear on small screen devices.-->
        <!--================================
        <div class="mainnav-brand">
            <a href="index.html" class="brand">
                <img src="img/logo.png" alt="Nifty Logo" class="brand-icon">
                <span class="brand-text">Nifty</span>
            </a>
            <a href="#" class="mainnav-toggle"><i class="pci-cross pci-circle icon-lg"></i></a>
        </div>
        -->



        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <!--Profile Widget-->
                    <!--================================-->
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <img class="img-circle img-md" src="{{asset('image/profile-prueba.jpg')}}" alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                <span class="pull-right dropdown-toggle">
                                    <i class="dropdown-caret"></i>
                                </span>
                                <p class="mnp-name"></p>

                                
                                <span class="mnp-desc">{{ Auth::user()->email }}</span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="{{route('profile.edit')}}" class="list-group-item">
                                <i class="demo-pli-male icon-lg icon-fw"></i> Ver Perfil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="list-group-item" style="cursor: pointer;" onclick="event.preventDefault(); this.closest('form').submit();"><i class="demo-pli-unlock icon-lg icon-fw"></i>
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
                            <a href="{{route('dashboard')}}" style="cursor: pointer;">
                                <i class="fa-solid fa-table-columns"></i>
                                <span class="menu-title">Panel</span>
                            </a>
                        </li>
                        <li class="{{request()->routeIs('role') ? 'modern-header' : 'modern-header-desactive'}}">
                            <a href="{{route('role')}}" style="cursor: pointer;">
                                <i class="demo-pli-home"></i>
                                <span class="menu-title">Role</span>
                            </a>
                        </li>
                        <li class="{{request()->routeIs('super-admin') ? 'modern-header' : 'modern-header-desactive'}}">
                            <a href="{{route('super-admin')}}" style="cursor: pointer;">
                                <i class="fa-solid fa-user-tie"></i>
                                <span class="menu-title">Administrador</span>
                            </a>
                        </li>
                        <li class="{{request()->routeIs('dojos') ? 'modern-header' : 'modern-header-desactive'}}">
                            <a href="{{route('dojos')}}" style="cursor: pointer;">
                                <i class="fa-solid fa-vihara"></i>
                                <span class="menu-title">Dojos</span>
                            </a>
                        </li>
                        <li class="{{request()->routeIs('senseis') ? 'modern-header' : 'modern-header-desactive'}}">
                            <a href="{{route('senseis')}}" style="cursor: pointer;">
                                <i class="fa-solid fa-user-ninja"></i>
                                <span class="menu-title">Senseis</span>
                            </a>
                        </li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-split-vertical-2"></i>
                                <span class="menu-title">Layouts</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="layouts-collapsed-navigation.html">Collapsed Navigation</a></li>
                                <li><a href="layouts-offcanvas-navigation.html">Off-Canvas Navigation</a></li>
                                <li><a href="layouts-offcanvas-slide-in-navigation.html">Slide-in Navigation</a></li>			
                            </ul>
                        </li>
                        <li class="list-divider"></li>
            
                        <!--Category name-->
                        <li class="list-header">More</li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-computer-secure"></i>
                                <span class="menu-title">App Views</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="app-file-manager.html">File Manager</a></li>
                                <li><a href="app-users.html">Users</a></li>
                                <li><a href="app-users-2.html">Users 2</a></li>
                                <li><a href="app-profile.html">Profile</a></li>
                                <li><a href="app-calendar.html">Calendar</a></li>
                                <li><a href="app-taskboard.html">Taskboard</a></li>
                                <li><a href="app-chat.html">Chat</a></li>
                                <li><a href="app-contact-us.html">Contact Us</a></li>
                                
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