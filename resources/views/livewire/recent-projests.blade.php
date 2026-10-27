<tbody wire:poll.30s> {{-- Refresh every 30 seconds --}}
    @if($projects->isNotEmpty())
        @foreach($projects as $project)
            <tr>
                <th scope="row">{{ $project->plist_projectid }}</th>
                <td>{{ $project->plist_title }}</td>
                <td>{{ $project->plist_startdate }}</td>
                <td>{{ $project->plist_enddate }}</td>

                {{-- Progress column (circular) --}}
                @php
                    // ensure numeric and clamped 0..100
                    $progress = isset($project->progress) ? round((float)$project->progress, 2) : 0;
                    $progress = $progress < 0 ? 0 : ($progress > 100 ? 100 : $progress);
                @endphp

                <td class="progress-cell" style="min-width: 140px;">
                    <div class="d-flex align-items-center gap-2">
                        <div class="circular-ring" role="img" aria-label="Project progress {{ $progress }} percent"
                             style="--progress: {{ $progress }};">
                            <div class="inner">
                                <span class="value">{{ $progress }}%</span>
                            </div>
                        </div>

                        {{-- optional: textual progress for screen readers / extra clarity --}}
                        <div class="d-none d-sm-block">
                            <small class="text-muted">Progress</small><br>
                            <strong>{{ $progress }}%</strong>
                        </div>
                    </div>
                </td>

                <td>
                    <a href="{{ url('customer/session/track-project-report-location/' . $project->plist_id) }}"
                        class="btn btn-sm btn-outline-primary" title="Track Progress">
                        <i class="fa fa-location-arrow"></i>
                    </a>
                </td>
                <td>
                    <a href="{{ url('customer/session/project-details/' . $project->plist_id) }}"
                        class="btn btn-sm btn-outline-primary" title="Project Details">
                        <i class="fa fa-folder-open"></i>
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
