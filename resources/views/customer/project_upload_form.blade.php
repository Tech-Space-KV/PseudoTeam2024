@extends('customer.base_layout')

@section('content')

    </br>
    <div class="container">
        <div class="">
            <h2>Upload a project</h2>

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

        </div>

        <form action="/project/store" method="POST" enctype="multipart/form-data">
            @csrf
            <h5 class="mt-4 mb-4 text-pseudo">
                <span class="fa fa-bars"></span> First details of the project
            </h5>


            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="plist_title" placeholder="Project title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" class="form-control" name="plist_description"
                    placeholder="Enter your description here" required></textarea>
            </div>

            <div class="mb-3">
                <label for="sow" class="form-label">Scope of work</label>
                <input type="file" class="form-control" id="sow" name="plist_sow" placeholder="Scope of work">
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="projectIs" class="form-label">Project is</label>
                    <select class="form-select" id="projectIs" name="plist_ongnew" required>
                        <option selected>--Select type--</option>
                        <option value="New">New</option>
                        <option value="On Going">On Going</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="projectType" class="form-label">Project type</label>
                    <select class="form-select" id="projectType" name="plist_type" required>
                        <option selected>--Select type--</option>
                        <option value="On Site">On Site</option>
                        <option value="On Remote">On Remote</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="projectCategory" class="form-label">Project Category</label>
                    <select class="form-select" id="projectCategory" name="plist_category" required>
                        <option selected>--Select category--</option>
                        <option value="Pre Sales Support">Pre Sales Support</option>
                        <option value="Implementation">Implementation</option>
                        <option value="Post Sales Support">Post Sales Support</option>
                        <option value="Software/Web Development">Software/Web Development</option>
                        <option value="Resource">Resource</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="budget" class="form-label">Budget</label>

                <div class="d-flex">
                    <div class="me-2" style="flex: 0.3;">
                        <select class="form-select" id="budget" name="plist_currency" required>
                            <option selected>Currency</option>
                            <option value="INR">INR</option>
                            <option value="USD">USD</option>
                            <option value="JPY">JPY</option>
                        </select>
                    </div>

                    <div style="width: 465px;">
                        <input type="number" class="form-control" id="budgetAmount" name="plist_budget"
                            placeholder="Enter amount" required>
                    </div>
                </div>
            </div>

            <h5 class="mt-4 mb-4 text-pseudo">
                <span class="fa fa-bars"></span> Define interval
            </h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="startDate" class="form-label">Start date</label>
                    <input type="date" class="form-control" id="startDate" name="plist_startdate" placeholder="Start date"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="endDate" class="form-label">End date</label>
                    <input type="date" class="form-control" id="endDate" name="plist_enddate" placeholder="End date"
                        required>
                </div>
            </div>


            <h5 class="mt-4 mb-4 text-pseudo">
                <span class="fa fa-bars"></span> Details of the person to be contacted by PseudoTeam
            </h5>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="title" name="plist_name"
                    placeholder="Name of the authorised person" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="title" name="plist_email"
                    placeholder="Email of the authorised person" required>
            </div>

            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control" id="title" name="plist_contact"
                    placeholder="Contact no. of authorised person" required>
            </div>

            <h5 class="mt-4 mb-4 text-pseudo">
                <span class="fa fa-bars"></span> Updates on additional/customer email id <sup>(Optional)</sup>
            </h5>

            <div class="mb-3">
                <div class="custom-switch">
                    <label class="slider-label" for="customSwitch">Receive notification emails</label>
                    <input type="checkbox" id="customSwitch" name="plist_checkrcv">
                    <label class="slider" for="customSwitch"></label>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Additional Email (Optional)</label>
                <input type="email" class="form-control" id="emailInput" name="plist_additional_email"
                    placeholder="Additional email" readonly>
            </div>

            <h5 class="mt-4 mb-4 text-pseudo">
                <span class="fa fa-bars"></span> Apply coupons/promo code <sup>(Optional)</sup>
            </h5>

            <div class="mb-3">
                <label for="coupon" class="form-label">Coupon/Promo Code</label>
                <input type="text" class="form-control" id="title" name="plist_coupon"
                    placeholder="Add your coupon or promocode here">
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>

        </form>
    </div>

    <script>

        const emailInput = document.getElementById('emailInput');
        const checkbox = document.getElementById('customSwitch');

        emailInput.setAttribute('readonly', true);


        checkbox.addEventListener('change', function () {
            if (this.checked) {
                emailInput.removeAttribute('readonly');
            } else {
                emailInput.setAttribute('readonly', true);
            }
        });
    </script>

@endsection