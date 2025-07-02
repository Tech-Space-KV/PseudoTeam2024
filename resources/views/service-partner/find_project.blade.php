@extends('service-partner.base_layout')

@section('content')

</br>
<div class="container">
    <div class="mb-4">
        <h2>Available projects</h2>
    </div>

    <!-- @foreach($projects as $project)
    <div class="card p-3 bg-light btn-outline-primary my-3 text-dark">
        <h5>{{ $project->plist_title }}: {{ $project->plist_projectid }}</h5>
        <textarea class="form-control border-0 bg-transparent" readonly rows="2">{{ $project->plist_description }}</textarea>
        <br>
        <a href="{{ url('service-partner/session/find-project-details?project_id=' . $project->plist_projectid) }}" class="text-decoration-none">View Project details</a>

    </div>
@endforeach -->

<div>
    @if($projects->isNotEmpty())
        @foreach($projects as $project)
            <div class="card p-3 bg-light btn-outline-primary my-3 text-dark"> 
                <h5><strong>Project ID: </strong>{{ $project->plist_projectid }}</h5>
                <p><strong>Title: </strong> {{ $project->plist_title }}</p>
                <p><strong>Description: </strong> {{ $project->plist_description }}</p>
                <p><strong>Manager Name:</strong> {{ $project->manager->username }}</p>
                <p><strong>Manager Email:</strong> {{ $project->manager->email }}</p>
                <a href="{{  url('service-partner/session/manage_project_location/'.$project->plist_id)  }}"
                  class="btn btn-sm btn-outline-primary" title="Track Progress">
                  <i class="fa fa-folder-open"></i> Open Project
                </a>
            </div>
        @endforeach
    @else
        <div class="card p-3 bg-light my-3 text-dark">
            <p>Projects not Available.</p>
        </div>
    @endif
</div>




</div>

@endsection
