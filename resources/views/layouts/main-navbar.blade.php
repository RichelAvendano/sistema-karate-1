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
                                <p class="mnp-name">{{ Auth::user()->name }}</p>
                                <span class="mnp-desc">{{ Auth::user()->email }}</span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-gear icon-lg icon-fw"></i> Settings
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-information icon-lg icon-fw"></i> Help
                            </a> 
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a :href="route('logout')" class="list-group-item" style="cursor: pointer;" onclick="event.preventDefault(); this.closest('form').submit();"><i class="demo-pli-unlock icon-lg icon-fw"></i>
                                    {{ __('Cerrar Sesión') }}
                                </a>
                            </form>      
                        </div>
                    </div>

                    <ul id="mainnav-menu" class="list-group">
            
                        <!--Category name-->
                        <li class="list-header">Navigation</li>
            
                        <!--Menu list item-->
                        <li class="{{request()->routeIs('dashboard') ? 'active-sub' : ''}}">
                            <a href="{{route('dashboard')}}" style="cursor: pointer;">
                                <i class="demo-pli-home"></i>
                                <span class="menu-title">Panel</span>
                            </a>
                        </li>
                        <li class="{{request()->routeIs('role') ? 'active-sub' : ''}}">
                            <a href="{{route('role')}}" style="cursor: pointer;">
                                <i class="demo-pli-home"></i>
                                <span class="menu-title">Role</span>
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
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-speech-bubble-5"></i>
                                <span class="menu-title">Blog Apps</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog-list.html">Blog List</a></li>
                                <li><a href="blog-list-2.html">Blog List 2</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                                <li class="list-divider"></li>
                                <li><a href="blog-manage-posts.html">Manage Posts</a></li>
                                <li><a href="blog-add-edit-post.html">Add Edit Post</a></li>
                                
                            </ul>
                        </li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-mail"></i>
                                <span class="menu-title">Email</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="mailbox.html">Inbox</a></li>
                                <li><a href="mailbox-message.html">View Message</a></li>
                                <li><a href="mailbox-compose.html">Compose Message</a></li>
                                <li><a href="mailbox-templates.html">Email Templates</a></li>
                                
                            </ul>
                        </li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-file-html"></i>
                                <span class="menu-title">Other Pages</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="pages-blank.html">Blank Page</a></li>
                                <li><a href="pages-invoice.html">Invoice</a></li>
                                <li><a href="pages-search-results.html">Search Results</a></li>
                                <li><a href="pages-faq.html">FAQ</a></li>
                                <li><a href="pages-pricing.html">Pricing<span class="label label-success pull-right">New</span></a></li>
                                <li class="list-divider"></li>
                                <li><a href="pages-404-alt.html">Error 404 alt</a></li>
                                <li><a href="pages-500-alt.html">Error 500 alt</a></li>
                                <li class="list-divider"></li>
                                <li><a href="pages-404.html">Error 404 </a></li>
                                <li><a href="pages-500.html">Error 500</a></li>
                                <li><a href="pages-maintenance.html">Maintenance</a></li>
                                <li><a href="pages-login.html">Login</a></li>
                                <li><a href="pages-register.html">Register</a></li>
                                <li><a href="pages-password-reminder.html">Password Reminder</a></li>
                                <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                                
                            </ul>
                        </li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-photo-2"></i>
                                <span class="menu-title">Gallery</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="gallery-columns.html">Columns</a></li>
                                <li><a href="gallery-justified.html">Justified</a></li>
                                <li><a href="gallery-nested.html">Nested</a></li>
                                <li><a href="gallery-grid.html">Grid</a></li>
                                <li><a href="gallery-carousel.html">Carousel</a></li>
                                <li class="list-divider"></li>
                                <li><a href="gallery-slider.html">Slider</a></li>
                                <li><a href="gallery-default-theme.html">Default Theme</a></li>
                                <li><a href="gallery-compact-theme.html">Compact Theme</a></li>
                                <li><a href="gallery-grid-theme.html">Grid Theme</a></li>
                                
                            </ul>
                        </li>


                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-tactic"></i>
                                <span class="menu-title">Menu Level</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="#">Second Level Item</a></li>
                                <li><a href="#">Second Level Item</a></li>
                                <li><a href="#">Second Level Item</a></li>
                                <li class="list-divider"></li>
                                <li>
                                    <a href="#">Third Level<i class="arrow"></i></a>

                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="#">Third Level Item</a></li>
                                        <li><a href="#">Third Level Item</a></li>
                                        <li><a href="#">Third Level Item</a></li>
                                        <li><a href="#">Third Level Item</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Third Level<i class="arrow"></i></a>

                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="#">Third Level Item</a></li>
                                        <li><a href="#">Third Level Item</a></li>
                                        <li class="list-divider"></li>
                                        <li><a href="#">Third Level Item</a></li>
                                        <li><a href="#">Third Level Item</a></li>
                                    </ul>
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