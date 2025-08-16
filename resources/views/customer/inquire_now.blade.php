@extends('customer.base_layout')

@section('content')

    </br>
    <div class="container">
        <div class="">
            <h2 class="fw-bold">Inquire Now</h2>

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

        <form action="{{ route('inquire.now') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h5 class="mt-4 mb-4 text-pseudo">
                <span class="fa fa-bars"></span> Raise an Inquiry
            </h5>

            <!-- Project Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Inquiry Summary</label>
                <input type="text" class="form-control" id="title" name="inquiry_summary" placeholder="Inquiry Summary"
                    required>
            </div>

            <!-- Project Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Inquiry Description</label>
                <textarea id="description" class="form-control" name="inquiry_description"
                    placeholder="Enter your description here" required></textarea>
            </div>

            <!-- Project Type -->
            <div class="row">

                <div class="col-md-4 mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category" required>
                        <option selected disabled>--Select category--</option>
                        <option value="Pre Sales Support">Pre Sales Support</option>
                        <option value="Implementation">Implementation
                        </option>
                        <option value="Post Sales Support">Post Sales
                            Support</option>
                        <option value="Software/Web Development">Software/Web Development</option>
                        <option value="Resource">Resource</option>
                        <option value="Cosultation">Cosultation</option>
                        <option value="CriticalSpares">Critical Spares</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Inquire Now!</button>
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