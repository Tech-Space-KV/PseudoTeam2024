<!-- resources/views/customer/page1.blade.php -->
@extends('customer.base_layout')

@section('content')

    <!-- <div class="container d-flex justify-content-between align-items-center py-3">
        <div>
            <h2 class="fw-bold">Track your project - Task timeline</h2>
        </div>
    </div> -->

<div class="container py-3">
    <div class="mb-4 d-flex align-items-center">
        <a href="javascript:history.back()"
           class="btn btn-outline-primary btn-sm me-2">
            <i class="fa fa-arrow-left"></i>
        </a>

        <h2 class="fw-bold mb-0">Track your project - Task timeline</h2>
    </div>
</div>

    <style>
        /* Overall battery bar */
        .battery-bar {
            display: flex;
            gap: 4px;
            height: 25px;
            border: 2px solid #ccc;
            border-radius: 6px;
            padding: 2px;
        }

        .battery-cell {
            flex: 1;
            border-radius: 4px;
            background-color: #e0e0e0;
            transition: background-color 0.3s ease;
        }

        .battery-cell.filled-low {
            background-color: #28a745;
        }

        /* Red */
        .battery-cell.filled-mid {
            background-color: #28a745;
        }

        /* Yellow */
        .battery-cell.filled-high {
            background-color: #28a745;
        }

        /* Blue */

        /* Individual task loader bar */
        .task-loader-bar {
            width: 100%;
            height: 12px;
            background-color: #e0e0e0;
            border-radius: 6px;
            overflow: hidden;
            margin-top: 4px;
        }

        .task-loader-fill {
            height: 100%;
            background-color: #0d6efd;
            /* Blue fill */
            transition: width 0.5s ease-in-out;
            border-radius: 6px 0 0 6px;
        }

        .battery-cell {
            flex: 1;
            border-radius: 4px;
            background-color: #e0e0e0;
            overflow: hidden;
            position: relative;
        }

        .battery-fill {
            height: 100%;
            transition: width 0.3s ease;
        }

        .filled-low {
            background-color: #28a745;
        }

        .filled-mid {
            background-color: #28a745;
        }

        .filled-high {
            background-color: #28a745;
        }
    </style>

    <!-- Overall Task Completion (Battery Bar) -->
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="fw-bold mb-2">Overall Milestone Status</h4>
            <p class="text-muted mb-1">
                Across all tasks in this milestone: <strong>{{ $overallProgress }}%</strong> completed
            </p>

            @php
                $totalCells = 10;
                $progress = $overallProgress;

                if ($progress <= 30) {
                    $fillLevel = 'filled-low';
                } elseif ($progress <= 60) {
                    $fillLevel = 'filled-mid';
                } else {
                    $fillLevel = 'filled-high';
                }
            @endphp

            <div class="battery-bar mt-2">
                @for ($i = 1; $i <= $totalCells; $i++)

                    @php
                        $cellStart = ($i - 1) * 10;
                        $cellEnd = $i * 10;

                        if ($progress >= $cellEnd) {
                            $width = 100;
                        } elseif ($progress > $cellStart) {
                            $width = ($progress - $cellStart) * 10;
                        } else {
                            $width = 0;
                        }
                    @endphp

                    <div class="battery-cell">
                        <div class="battery-fill {{ $fillLevel }}" style="width: {{ $width }}%"></div>
                    </div>

                @endfor
            </div>

            <div class="small text-muted mt-1">{{ $overallProgress }}% completed (across all tasks)</div>
        </div>
    </div>

    <!-- Timeline with Individual Task Progress -->
     <div class="timeline">

@if ($projectTimeline->isNotEmpty())

    @foreach ($projectTimeline as $pt)

        <div class="timeline-item">

            <div class="timeline-item-content">

                <h4>{{ $pt->pptasks_task_title }}</h4>

                <span>
                    Status:
                    {{ $pt->pptasks_pt_status }}
                </span>
                <br>

                <span>
                    Weightage:
                    {{ $pt->pptasks_weightage }}%
                </span>
                <br>

                <span class="date">
                    {{ $pt->pptasks_date_of_completion }}
                </span>

                @php
                    $taskProgress = $pt->progress;
                @endphp

                <div class="task-loader-bar mt-2">
                    <div
                        class="task-loader-fill"
                        style="width: {{ $taskProgress }}%">
                    </div>
                </div>

                <div class="small text-muted mt-1">
                    {{ $taskProgress }}% completed
                    (weighted:
                    {{ $pt->weighted_progress }}%)
                </div>

               <div class="mt-3 d-flex align-items-center gap-2">

    <!-- Show Activity -->
    <button
        class="btn btn-sm btn-outline-primary"
        data-bs-toggle="collapse"
        data-bs-target="#activity{{ $pt->pptasks_id }}">

        Show Activity

    </button>


    <!-- Download Proof of Completion -->
    @if(
        (int) $pt->pptasks_proof_completion_approved === 1 &&
        !empty($pt->pptasks_proof_of_completion)
    )

        <a
            href="{{ route(
                'customer.task.download-proof',
                $pt->pptasks_id
            ) }}"
            class="btn btn-sm btn-outline-success"
            title="Download Proof of Completion">

            <i class="fa fa-download"></i>

        </a>

    @endif

</div>

                <div
                    class="collapse mt-3"
                    id="activity{{ $pt->pptasks_id }}">

                    @if($pt->approved_comments->count())

                        @foreach($pt->approved_comments as $comment)

                            <div class="card mb-2">

                                <div class="card-body">

                                    <div class="d-flex justify-content-between">

                                        <strong>

                                            {{
                                                $comment->username
                                                ??
                                                $comment->sprov_name
                                                ??
                                                'User'
                                            }}

                                        </strong>

                                        <small>

                                            {{
                                                date(
                                                    'd M Y h:i A',
                                                    strtotime(
                                                        $comment->tconv_comment_date_time
                                                    )
                                                )
                                            }}

                                        </small>

                                    </div>

                                    <hr>

                                    <p class="mb-0">

                                        {{
                                            $comment->tconv_comment
                                        }}

                                    </p>

                                </div>

                            </div>

                        @endforeach

                    @else

                        <div class="alert alert-info">

                            No approved activity available.

                        </div>

                    @endif

                </div>

            </div>

        </div>

    @endforeach

@else

    <div class="text-center text-muted my-4">
        <strong>No timeline found.</strong>
    </div>

@endif

</div>

@endsection