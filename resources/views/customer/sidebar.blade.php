<div class="sidebar" id="sidebar">
    <a class="navbar-brand mx-auto" href="/">
        <img src="{{ asset('images/logopt.png') }}" id="set-img-logo" class="rounded-3 mx-auto" style="width: 150px; margin-bottom:-30px; margin-top:-20px;">
    </a>
</br>
    <div class="container text-light">
        {{-- <div class="row justify-content-md-center mt-2">
            <div class="col col-lg-5 d-flex flex-column align-items-center mx-2">
                <p class="" style="color: #505155;">Navigation</p>
            </div>
        </div> --}}
        <div class="row justify-content-md-center">
            <div class="col col-lg-10 sitem  d-flex flex-column align-items-center mx-2 text-decoration-none">
                     <a href="{{ url('customer/session/') }}" class="text-decoration-none"><i class="fa fa-object-group card cardbg p-3 w-100 iconix"></i>
                    <span class="fst">Dashboard</span></a>
            </div>       
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2 text-decoration-none">
                  <a href="{{ url('customer/session/upload-project') }}" class="text-decoration-none">   <i class="fa fa-upload card cardbg p-3 iconix"></i>
                  </a> <span class="fst">Upload Project</span>
            </div>
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2 text-decoration-none">
                   <a href="{{ url('customer/session/track-project-report') }}" class="text-decoration-none"> <i class="fa fa-line-chart card cardbg p-3 iconix"></i>
                   </a><span class="fst">Track Project</span>
            </div>        
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2 text-decoration-none">
                <a href="{{ url('customer/session/reports') }}" class="text-decoration-none">     <i class="fa fa-object-group card cardbg p-3 iconix"></i>
                </a>  <span class="fst">Reports</span> 
            </div>
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2 text-decoration-none">
                <a href="{{ url('customer/session/marketplace/hardwares') }}" class="text-decoration-none">    <i class="fa fa-cubes card cardbg p-3 iconix"></i>
                </a>   <span class="fst">Marketplace</span> 
            </div>        
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2 text-decoration-none">
                <a href="{{ url('customer/session/help') }}" class="text-decoration-none">     <i class="fa fa-phone-square card cardbg p-3 iconix"></i>
                </a>   <span class="fst">Help</span> 
            </div>
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2 text-decoration-none">
                <a href="{{ url('customer/session/profileoptions') }}" class="text-decoration-none">    <i class="fa fa-id-card-o card cardbg p-3 iconix"></i>
                </a> <span class="fst">Account</span>
            </div>        
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-10  d-flex flex-column align-items-center mx-2 text-decoration-none">
                <a href="{{ url('customer/session/referandearn') }}"> <div class="card cardbg w-100 p-1">
                        <img src="{{ asset('images/refer-img.png') }}" class="rounded-3 w-100">
                     </div> </a>
                     <span class="fst">Refer a Friend</span> 
            </div>       
        </div>
        
        <div class="row justify-content-md-center">
            <div class="col col-lg-10 sitem  d-flex flex-column align-items-center mx-2 text-decoration-none">
                     <a href="{{ url('customer/session/trackticket') }}" class="text-decoration-none"><i class="fa fa-ticket card cardbg p-3 w-100 iconix"></i>
                    <span class="fst">Tickets</span></a>
            </div>       
        </div>

    </div>
</div>
