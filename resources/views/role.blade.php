<x-app-layout>
    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">
            <div id="page-head">
                
                <div class="pad-all text-center">
                    <h3>Mira los Roles</h3>
                </div>
            </div>

            
            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">
                
                <div class="row">
                    <div class="col-lg-12">
            
                        <div class="panel h-">
                            <div class="panel-body">
                                <h1>Estos son los roles</h1>
                                <h2>Tienes el rol de {{$user->role}}</h2>
                                @if ($user->role == 'admin')
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle-fill"></i>Esto solo lo puede ver un admin
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>				
                    
            </div>
            <!--===================================================-->
            <!--End page content-->

        </div>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->
    </div>
</x-app-layout>
