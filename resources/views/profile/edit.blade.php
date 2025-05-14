<x-app-layout>
    
    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">
            <div id="page-head" style="margin-bottom: 20px;">
                
                <div class="pad-all text-center" style="background: linear-gradient(135deg, #ff010121, #00aaff26); max-width: 300px">
                    <h3 id="color-title-glass" style=" color: black !important">Perfil de Usuario</h3>
                    <p1 id="color-title-glass">Actualice sus datos o borre la cuenta</p1>                   
                </div>
            </div>

            
            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">
                
                <div class="row">
                    <div class="col-lg-12">
                        @livewire('form-profile-edit')
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
