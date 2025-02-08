@extends('service-partner.base_layout')

@section('content')

</br>
<div class="container">
    <div class="mb-4">
        <h2>Find projects</h2>
    </div>

    @foreach($projects as $project)
    <div class="card p-3 bg-light btn-outline-primary my-3 text-dark">
        <h5>{{ $project->plist_title }}: {{ $project->plist_projectid }}</h5>
        <textarea class="form-control border-0 bg-transparent" readonly rows="2">{{ $project->plist_description }}</textarea>
        <br>
        <a href="{{ url('service-partner/session/find-project-details?project_id=' . $project->plist_projectid) }}" class="text-decoration-none">View Project details</a>

    </div>
@endforeach



</div>

@endsection
