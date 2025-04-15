<x-app-layout>
    
    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">
            <div id="page-head">
                
                <div class="pad-all text-center">
                    <h3>Welcome back to the Dashboard.</h3>
                    <p1>Scroll down to see quick links and overviews of your Server, To do list, Order status or get some Help using Nifty</p1>
                    
                </div>
            </div>

            
            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">
                
                <div class="panel">
                    <div class="panel-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <div class="card shadow rounded-lg">
                                        <div class="card-body p-4">
                                            <div class="max-w-xl">
                                                @include('profile.partials.update-profile-information-form')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="card shadow rounded-lg">
                                        <div class="card-body p-4">
                                            <div class="max-w-xl">
                                                @include('profile.partials.update-password-form')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="card shadow rounded-lg">
                                        <div class="card-body p-4">
                                            <div class="max-w-xl">
                                                @include('profile.partials.delete-user-form')
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script src="{{asset('plugins\bootbox\bootbox.min.js')}}"></script>
    <script src="{{asset('js\demo\ui-modals.js')}}"></script>
</x-app-layout>
