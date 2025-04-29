<tbody wire:poll.30s> {{-- Refresh every 5 minutes --}}
@if($projects->isNotEmpty())
    @foreach($projects as $project)
       <tr>
         <th scope="row">{{ $project->plist_projectid }}</th>
         <td>{{ $project->plist_title }}</td>
         <td>{{ $project->plist_startdate }}</td>
         <td>{{ $project->plist_enddate }}</td>
         <td>{{ $project->plist_status }}</td>
         <td>
             <a href="{{ url('customer/session/track-project-report-location/'.$project->plist_id) }}" class="btn btn-sm btn-outline-primary" title="Track Progress">
                 <i class="fa fa-location-arrow"></i>
             </a>
         </td> 
         <td>
             <a href="{{ url('customer/session/project-details/'.$project->plist_id) }}">
                 <i class="fa fa-eye btn btn-sm btn-outline-primary"></i>
             </a>
         </td>
       </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="text-center">No projects found!</td>
    </tr>
@endif
</tbody>

