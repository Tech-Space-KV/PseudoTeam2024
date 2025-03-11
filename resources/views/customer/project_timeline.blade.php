<!-- resources/views/customer/page1.blade.php -->
@extends('customer.base_layout')

@section('content')

<div class="container d-flex justify-content-between align-items-center py-3">
    <!-- Project Timeline Section -->
    <div>
        <h2 class="mb-0">Project Timeline: &lt;Project ID : {{ $projectTimeline->pptasks_planner_id }}&gt;</h2>
    </div>

    <!-- Share Invite Section -->
    <div class="d-flex flex-column align-items-center bg-light shadow-sm p-3 rounded" style="max-width: 300px;">
        <!-- "Share via" Text -->
        <p class="mb-2 fw-bold text-pseudo">Share via:</p>
        <!-- Logos -->
        <div class="d-flex gap-2">
            <!-- WhatsApp Button -->
            <a href="https://wa.me/?text=Check%20out%20this%20awesome%20platform!" target="_blank" class="d-flex align-items-center justify-content-center text-decoration-none">
                <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" class="img-fluid" style="width: 30px; height: 30px;">
            </a>
            <!-- Mail Button -->
            <a href="https://www.gmail.com/" target="_blank" class="d-flex align-items-center justify-content-center text-decoration-none">
                <img src="{{ asset('images/mail.jpeg') }}" alt="Mail" class="img-fluid" style="width: 35px; height: 35px;">
            </a>
        </div>
    </div>
</div>



<div class="timeline">
    <div class="timeline-item">
        <div class="timeline-item-content">
            <h4>{{ $projectTimeline->pptasks_task_title }}</h4>
            <span class="date">{{ $projectTimeline->pptasks_date_of_completion }}</span>
        </div>
    </div>
    <!-- <div class="timeline-item">
        <div class="timeline-item-content">
            <h4>{{ $projectTimeline->pptasks_pt_status }}</h4>
            <span class="date">{{ $projectTimeline->pptasks_date_of_completion }}</span>
        </div>
    </div> -->
    <!-- <div class="timeline-item">
        <div class="timeline-item-content">
            <h4>Hardware Marketplace Functionality</h4>
            <span class="date">{{ $projectTimeline->pptasks_date_of_completion }}</span>
        </div>
    </div> -->
    <!-- <div class="timeline-item">
        <div class="timeline-item-content">
            <h4>Signup/Signin Forms</h4>
            <span class="date">2024-09-14</span>
        </div>
    </div>
    <div class="timeline-item">
        <div class="timeline-item-content">
            <h4>OpenProject App Test</h4>
            <span class="date">2024-09-14</span>
        </div>
    </div> -->
</div>
</div>



@endsection