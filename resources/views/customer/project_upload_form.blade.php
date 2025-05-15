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

        <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data" @if($readonly) disabled @endif>
            @csrf
            <h5 class="mt-4 mb-4 text-pseudo">
                <span class="fa fa-bars"></span> First details of the project
            </h5>

            <input type="hidden" name="plist_id" value="{{ $readonly ? ($project->plist_id ?? '') : old('plist_id', $project->plist_id ?? '') }}"
            {{ $readonly ? 'readonly' : '' }} >

            <!-- Project Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="plist_title" placeholder="Project title"
                    value="{{ $readonly ? ($project->plist_title ?? '') : old('plist_title', $project->plist_title ?? '') }}"
                    {{ $readonly ? 'readonly' : '' }} required>
            </div>

            <!-- Project Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" class="form-control" name="plist_description"
                    placeholder="Enter your description here" {{ $readonly ? 'readonly' : '' }}
                    required>{{ $readonly ? ($project->plist_description ?? '') : old('plist_description', $project->plist_description ?? '') }}</textarea>
            </div>

            <!-- Scope of Work -->
            <div class="mb-3">
                <label for="sow" class="form-label">Scope of work</label>
                <input type="file" class="form-control" id="sow" name="plist_sow" placeholder="Scope of work" accept=""
                    value="{{ old('plist_sow', $project->plist_sow ?? '') }}" {{ $readonly ? 'readonly' : '' }}>
            </div>

            <!-- Project Type -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="projectIs" class="form-label">Project is</label>
                    <select class="form-select" id="projectIs" name="plist_ongnew" {{ $readonly ? 'disabled' : '' }}
                        required>
                        <option selected disabled>--Select type--</option>
                        <option value="New" {{ old('plist_ongnew', $project->plist_ongnew ?? '') == 'New' ? 'selected' : '' }}>New
                        </option>
                        <option value="On Going" {{ old('plist_ongnew', $project->plist_ongnew ?? '') == 'On Going' ? 'selected' : '' }}>On Going</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="projectType" class="form-label">Project type</label>
                    <select class="form-select" id="projectType" name="plist_type" required {{ $readonly ? 'disabled' : '' }}>
                        <option selected disabled>--Select type--</option>
                        <option value="On Site" {{ old('plist_type', $project->plist_type ?? '') == 'On Site' ? 'selected' : '' }}>
                            On Site</option>
                        <option value="On Remote" {{ old('plist_type', $project->plist_type ?? '') == 'On Remote' ? 'selected' : '' }}>On Remote</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="projectCategory" class="form-label">Project Category</label>
                    <select class="form-select" id="projectCategory" name="plist_category" required {{ $readonly ? 'disabled' : '' }}>
                        <option selected disabled>--Select category--</option>
                        <option value="Pre Sales Support" {{ old('plist_category', $project->plist_category ?? '') == 'Pre Sales Support' ? 'selected' : '' }}>Pre Sales Support</option>
                        <option value="Implementation" {{ old('plist_category', $project->plist_category ?? '') == 'Implementation' ? 'selected' : '' }}>Implementation
                        </option>
                        <option value="Post Sales Support" {{ old('plist_category', $project->plist_category ?? '') == 'Post Sales Support' ? 'selected' : '' }}>Post Sales
                            Support</option>
                        <option value="Software/Web Development" {{ old('plist_category', $project->plist_category ?? '') == 'Software/Web Development' ? 'selected' : '' }}>
                            Software/Web Development</option>
                        <option value="Resource" {{ old('plist_category', $project->plist_category ?? '') == 'Resource' ? 'selected' : '' }}>Resource</option>
                    </select>
                </div>
            </div>

            <!-- Budget Information -->
            <div class="mb-3">
                <label for="budget" class="form-label">Budget</label>
                <div class="d-flex">
                    <div class="me-2" style="flex: 0.3;">
                        <select class="form-select" id="budget" name="plist_currency" required {{ $readonly ? 'disabled' : '' }}>
                            <option selected disabled>Currency</option>
                            <option value="INR" {{ old('plist_currency', $project->plist_currency ?? '') == 'INR' ? 'selected' : '' }}>INR</option>
                            <option value="USD" {{ old('plist_currency', $project->plist_currency ?? '') == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="JPY" {{ old('plist_currency', $project->plist_currency ?? '') == 'JPY' ? 'selected' : '' }}>JPY</option>
                        </select>
                    </div>

                    <div style="width: 465px;">
                        <input type="number" class="form-control" id="budgetAmount" name="plist_budget"
                            placeholder="Enter amount"
                            value="{{ $readonly ? ($project->plist_budget ?? '') : old('plist_budget', $project->plist_budget ?? '') }}"
                            {{ $readonly ? 'readonly' : '' }} required>
                    </div>
                </div>
            </div>

            <!-- Start Date and End Date -->
            <h5 class="mt-4 mb-4 text-pseudo">
                <span class="fa fa-bars"></span> Define interval
            </h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="startDate" class="form-label">Start date</label>
                    <input type="date" class="form-control" id="startDate" name="plist_startdate" placeholder="Start date"
       value="{{ 
           $readonly 
           ? ($project && $project->plist_startdate ? \Carbon\Carbon::parse($project->plist_startdate)->format('Y-m-d') : '') 
           : old('plist_startdate', $project && $project->plist_startdate ? \Carbon\Carbon::parse($project->plist_startdate)->format('Y-m-d') : '') 
       }}"
       {{ $readonly ? 'readonly' : '' }} required>

                </div>

                <div class="col-md-6 mb-3">
                    <label for="endDate" class="form-label">End date</label>
                    <input type="date" class="form-control" id="endDate" name="plist_enddate" placeholder="End date"
       value="{{ 
           $readonly 
           ? ($project && $project->plist_enddate ? \Carbon\Carbon::parse($project->plist_enddate)->format('Y-m-d') : '') 
           : old('plist_enddate', $project && $project->plist_enddate ? \Carbon\Carbon::parse($project->plist_enddate)->format('Y-m-d') : '') 
       }}"
       {{ $readonly ? 'readonly' : '' }} required>

                </div>
            </div>

            <!-- Contact Details -->
            <h5 class="mt-4 mb-4 text-pseudo">
                <span class="fa fa-bars"></span> Details of the person to be contacted by PseudoTeam
            </h5>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="title" name="plist_name"
                    placeholder="Name of the authorised person"
                    value="{{ $readonly ? ($project->plist_name ?? '') : old('plist_name', $project->plist_name ?? '') }}"
                    {{ $readonly ? 'readonly' : '' }} required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="title" name="plist_email"
                    placeholder="Email of the authorised person"
                    value="{{ $readonly ? ($project->plist_email ?? '') : old('plist_email', $project->plist_email ?? '') }}"
                    {{ $readonly ? 'readonly' : '' }} required>
            </div>

            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control" id="title" name="plist_contact"
                    placeholder="Contact no. of authorised person"
                    value="{{ $readonly ? ($project->plist_contact ?? '') : old('plist_contact', $project->plist_contact ?? '') }}"
                    {{ $readonly ? 'readonly' : '' }} required>
            </div>

            @if (!$readonly)
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
                    <input type="email" class="form-control" id="emailInput" name="plist_customeremail"
                        placeholder="Additional email" value="{{ $readonly ? ($project->plist_customeremail ?? '') : old('plist_customeremail', $project->plist_customeremail ?? '') }}"  readonly>
                </div>

                <h5 class="mt-4 mb-4 text-pseudo">
                    <span class="fa fa-bars"></span> Apply coupons/promo code <sup>(Optional)</sup>
                </h5>

                <div class="mb-3">
                    <label for="coupon" class="form-label">Coupon/Promo Code</label>
                    <input type="text" class="form-control" id="title" name="plist_coupon"
                    value="{{ $readonly ? ($project->plist_coupon ?? '') : old('plist_coupon', $project->plist_coupon ?? '') }}"
                    placeholder="Add your coupon or promocode here">
                </div>
            @endif

            <button type="submit" class="btn btn-primary">{{ $readonly ? 'Save' : 'Upload' }}</button>
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