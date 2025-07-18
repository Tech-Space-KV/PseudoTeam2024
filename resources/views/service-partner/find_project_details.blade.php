@extends('service-partner.base_layout')

@section('content')
    <div class="container my-4">
        @if($project)
            <h4 class="fw-bold mb-3 pb-2 border-bottom">Project Details</h4>

            <div class="mb-4" id="message-container">
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

            <div class="p-4 rounded-3 shadow-sm bg-white border">
                <div class="mb-3">
                    <h6 class="text-muted mb-1">Project Title</h6>
                    <p class="text-dark fs-6 mb-0">{{ $project->plist_title }}</p>
                </div>
                <hr class="my-3">

                <div class="mb-3">
                    <h6 class="text-muted mb-1">Project ID</h6>
                    <p class="text-dark fs-6 mb-0">{{ $project->plist_projectid }}</p>
                </div>
                <hr class="my-3">

                <div class="mb-3">
                    <h6 class="text-muted mb-1">Description</h6>
                    <textarea class="form-control border-0 bg-light" readonly
                        rows="3">{{ $project->plist_description }}</textarea>
                </div>
                <hr class="my-3">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-1">Start Date</h6>
                        <p class="text-dark fs-6 mb-0">{{ $project->plist_startdate }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-1">End Date</h6>
                        <p class="text-dark fs-6 mb-0">{{ $project->plist_enddate }}</p>
                    </div>
                </div>
                <hr class="my-3">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-1">Type</h6>
                        <p class="text-dark fs-6 mb-0">{{ $project->plist_type }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-1">Category</h6>
                        <p class="text-dark fs-6 mb-0">{{ $project->plist_category }}</p>
                    </div>
                </div>
                <hr class="my-3">

                <!-- Comment Box -->
                <form action="{{ url('service-partner/session/show-interest/' . $project->plist_id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <h6 class="text-muted mb-1">Why are you interested in this project?</h6>
                        <textarea class="form-control shadow-sm" rows="3" placeholder="Write your reason here..."
                            name="sp_interest_reason"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Show Interest</button>
                </form>

                <!-- Show Interest Button -->
                <!-- <div class="text-end">
                        <a class="btn btn-primary px-4 py-2 rounded-pill shadow-sm" href="{{ url('service-partner/session/show-interest/' . $project->plist_id) }}">Show Interest</a>
                    </div> -->


            </div>
        @else
            <div class="alert alert-warning text-center">
                <h5 class="alert-heading">Project Not Found</h5>
                <p class="mb-0">The project you are looking for does not exist or may have been removed.</p>
            </div>
        @endif
    </div>
@endsection