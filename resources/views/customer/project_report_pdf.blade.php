<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/svg+xml"
        href="{{ asset('https://pseudoteam.com/PseudoTeam2024/public/favicon/favicon.svg') }}">
    <title>Project Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        h2 {
            margin-bottom: 10px;
        }

        h3 {
            margin-top: 20px;
        }

        h4 {
            margin: 10px 0 5px 0;
        }

        .section {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        td,
        th {
            border: 1px solid #999;
            padding: 8px;
        }
    </style>
</head>

<body>

    <h2>Project Report</h2>

    <div class="section">
        <strong>Project ID:</strong> {{ $project->plist_id }} <br>
        <strong>Title:</strong> {{ $project->plist_title }} <br>
        <strong>Status:</strong> {{ $project->plist_status }} <br>
        <strong>Start Date:</strong> {{ $project->plist_startdate }} <br>
        <strong>End Date:</strong> {{ $project->plist_enddate }} <br>
    </div>

    <hr>

    @foreach($project->locations as $loc)
        <h3>📍 Location: {{ $loc->pscope_city . ' ' . $loc->pscope_state . ' ' . $loc->pscope_country ?? 'Unnamed Location' }}
        </h3>

        @foreach($loc->milestones as $milestone)
            <h4>Milestone: {{ $milestone->pplnr_milestone ?? 'Milestone' }}</h4>

            <table>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($milestone->tasks as $task)
                        <tr>
                            <td>{{ $task->pptasks_task_title }}</td>
                            <td>{{ $task->pptasks_start_date }}</td>
                            <td>{{ $task->pptasks_end_date }}</td>
                            <td>{{ $task->pptasks_pt_status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No tasks found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endforeach

        <hr>
    @endforeach

    <p>Generated on {{ now()->format('d M Y H:i A') }}</p>

</body>

</html>