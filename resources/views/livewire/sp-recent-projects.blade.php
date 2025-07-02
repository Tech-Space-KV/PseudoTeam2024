<div wire:poll.30s>
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
                  <i class="fa fa-eye"></i> Track Progress
                </a>
            </div>
        @endforeach
    @else
        <div class="card p-3 bg-light my-3 text-dark">
            <p>No recent projects found.</p>
        </div>
    @endif
</div>
