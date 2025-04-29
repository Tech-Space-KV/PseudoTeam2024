<div class="progress-bar"
     role="progressbar"
     wire:poll.60s {{-- auto-refresh every 60 seconds --}}
     style="width: {{ $jobSuccessRate }}%;"
     aria-valuenow="{{ $jobSuccessRate }}"
     aria-valuemin="0"
     aria-valuemax="100">
    {{ $jobSuccessRate }}%
</div>