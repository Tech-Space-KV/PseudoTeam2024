@extends('service-partner.base_layout')

@section('content')

</br>
<div class="container">

    <div class="mb-4">
        <h2>Project Report</h2>
    </div>

    <!-- Doughnut Chart -->
    <div class="chart-container mx-auto" style="width: 40%; background: #f9f9f9; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <canvas id="statusChart"></canvas>
    </div>

    <!-- Progress Summary Section -->
    <div class="container text-center mt-4" style="max-width: 1000px; margin: auto;">
        <div class="row gx-3 gy-3">

            <!-- Not Started -->
            <div class="col-md-3">
                <div class="card p-3 text-white border-0 w-100"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; 
                       height: 80px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                       background-color: #ffcc00;">
                    <a href="{{ url('service-partner/session/project-reports-not-started') }}" style="text-decoration: none; color: inherit; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <h5 style="margin-bottom: 8px; font-size: 1rem; font-weight: normal;">Not Started</h5>
                        <h4 id="pendingCount" style="font-size: 1.5rem; font-weight: normal;">{{ $statuses['not_started'] ?? 0 }}</h4>
                    </a>
                </div>
            </div>

            <!-- FullFilled -->
            <div class="col-md-3">
                <div class="card p-3 text-white border-0 w-100"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; 
                       height: 80px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                       background-color: #28a745;">
                    <a href="{{ url('service-partner/session/project-reports-fullfilled') }}" style="text-decoration: none; color: inherit; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <h5 style="margin-bottom: 8px; font-size: 1rem; font-weight: normal;">FullFilled</h5>
                        <h4 id="deliveredCount" style="font-size: 1.5rem; font-weight: normal;">{{ $statuses['fullfilled'] ?? 0 }}</h4>
                    </a>
                </div>
            </div>

            <!-- On Going -->
            <div class="col-md-3">
                <div class="card p-3 text-white border-0 w-100"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; 
                       height: 80px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                       background-color: #007bff;">
                    <a href="{{ url('service-partner/session/project-reports-on-going') }}"  style="text-decoration: none; color: inherit; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <h5 style="margin-bottom: 8px; font-size: 1rem; font-weight: normal;">On Going</h5>
                        <h4 id="inProgressCount" style="font-size: 1.5rem; font-weight: normal;">{{ $statuses['on_going'] ?? 0 }}</h4>
                    </a>
                </div>
            </div>

            <!-- Scrapped -->
            <div class="col-md-3">
                <div class="card p-3 text-white border-0 w-100"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; 
                       height: 80px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                       background-color: #dc3545;">
                    <a href="{{ url('service-partner/session/project-reports-scrapped') }}" style="text-decoration: none; color: inherit; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <h5 style="margin-bottom: 8px; font-size: 1rem; font-weight: normal;">Scrapped</h5>
                        <h4 id="overdueCount" style="font-size: 1.5rem; font-weight: normal;">{{ $statuses['scrapped'] ?? 0 }}</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = ['Not Started', 'FullFilled', 'On Going', 'Scrapped'];
    const chartData = [
        {{ $statuses['not_started'] ?? 0 }},
        {{ $statuses['fullfilled'] ?? 0 }},
        {{ $statuses['on_going'] ?? 0 }},
        {{ $statuses['scrapped'] ?? 0 }}
    ];

    const ctx = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: chartData,
                backgroundColor: ['#ffcc00', '#28a745', '#007bff', '#dc3545'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            },
            cutout: '70%',
            onClick: (event, elements) => {
                if (elements.length > 0) {
                    const index = elements[0].index;
                    alert(`Status: ${labels[index]}\nCount: ${chartData[index]}`);
                }
            }
        }
    });
</script>

@endsection