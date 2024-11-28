<div class="rightbar" id="rightbar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <div class="mx-auto w-75" id="">
                <a  href="{{ url('customer/session/notifications') }}" type="button" class="btn btn-primary position-relative me-2" style="float: left;">
                    <i class="fa fa-bell text-white"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                      99+
                      <span class="visually-hidden">unread messages</span>
                    </span>
                  </a>

                  <a type="button" class="btn btn-outline-danger position-relative ms-2" style="float: right;">
                    Logout <i class="fa fa-sign-out"></i>
                  </a>

            </div>
        </div>
    </nav>
    <hr>
    <div class="container text-light">
        
        <div class="row justify-content-md-center mt-2">
            <div class="col col-lg-10 d-flex flex-column align-items-center mx-2">
                <p class="text-dark"><span class="fw-bold fs-3">Your Cart <i class="fa fa-shopping-cart"></i></span></p>
            </div>
        </div>
        
        <div class="row justify-content-md-center">
            <div class="col col-lg-10 sitem d-flex flex-column align-items-center mx-2"> 
                <div class="card p-3 w-100 cardbgylw">
                    <i class="fa fa-bullseye"></i> 3 items in your cart
                </div>
            </div>          
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2">
                     <i class="fa fa-upload card cardbg p-3"></i>
                    <span class="fst">Upload Project</span>
            </div>
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2">
                    <i class="fa fa-line-chart card cardbg p-3"></i>
                    <span class="fst">Track Project</span>
            </div>        
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2">
                     <i class="fa fa-object-group card cardbg p-3"></i>
                    <span class="fst">Reports</span>
            </div>
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2">
                    <i class="fa fa-cubes card cardbg p-3"></i>
                    <span class="fst">Marketplace</span>
            </div>        
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2">
                     <i class="fa fa-object-group card cardbg p-3"></i>
                    <span class="fst">Help</span>
            </div>
            <div class="col col-lg-5 sitem  d-flex flex-column align-items-center mx-2">
                    <i class="fa fa-cubes card cardbg p-3"></i>
                    <span class="fst">Account</span>
            </div>        
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-10  d-flex flex-column align-items-center mx-2"0>
                     <div class="card cardbg w-100 p-1">
                        <img src="{{ asset('images/refer-img.png') }}" class="rounded-3 w-100">
                     </div>
                    <span class="fst">Refer a Friend</span>
            </div>       
        </div>
        
        
    </div>
</div>
