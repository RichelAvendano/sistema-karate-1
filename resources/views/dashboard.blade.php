<x-app-layout>

    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">
            <div id="page-head" style="display:flex; justify-content:center;">
                
                <div class="pad-all text-center" style="">
                    <h3 id="color-title-glass">Dashboard</h3>
                    <p1 id="color-title-glass">Hola</p1>                
                </div>
            </div>

            
            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">
                
                <div class="row">
                    <div class="col-lg-12">           
                        <div class="panel">
                            <div class="panel-body">
                                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias architecto aliquid aspernatur sit exercitationem quaerat illum at repellat, mollitia quis ad natus provident asperiores velit magni enim laudantium expedita ipsam?</h3>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-body">
                                @livewire('counter', [
                                    'title' => 'Contador',
                                    'user'  => '1',
                                ])
                                
                            </div>                           
                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="" style="padding:10px">Paises</h3>
                            </div>
                            <div class="panel-body">
                                @livewire('paises')
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