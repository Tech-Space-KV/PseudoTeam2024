@extends('customer.base_layout')

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
            <!-- Pending -->
            <div class="col-md-3">
                <div class="card p-3 text-white border-0 w-100"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; 
                       height: 80px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                       background-color: #ffcc00;">
                    <a href="{{ url('customer/session/track-project-pending') }}" style="text-decoration: none; color: inherit; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <h5 style="margin-bottom: 8px; font-size: 1rem; font-weight: normal;">No SP Assigned</h5>
                        <h4 id="pendingCount" style="font-size: 1.5rem; font-weight: normal;">0</h4>
                    </a>
                </div>
            </div>

            <!-- Delivered -->
            <div class="col-md-3">
                <div class="card p-3 text-white border-0 w-100"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; 
                       height: 80px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                       background-color: #28a745;">
                    <a href="{{ url('customer/session/track-project-delivered') }}" style="text-decoration: none; color: inherit; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <h5 style="margin-bottom: 8px; font-size: 1rem; font-weight: normal;">Full-Filled</h5>
                        <h4 id="deliveredCount" style="font-size: 1.5rem; font-weight: normal;">0</h4>
                    </a>
                </div>
            </div>

            <!-- In Progress -->
            <div class="col-md-3">
                <div class="card p-3 text-white border-0 w-100"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; 
                       height: 80px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                       background-color: #007bff;">
                    <a href="{{ url('customer/session/track-project-in-progress') }}"  style="text-decoration: none; color: inherit; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <h5 style="margin-bottom: 8px; font-size: 1rem; font-weight: normal;">On-Going</h5>
                        <h4 id="inProgressCount" style="font-size: 1.5rem; font-weight: normal;">0</h4>
                    </a>
                </div>
            </div>

            <!-- Overdue -->
            <div class="col-md-3">
                <div class="card p-3 text-white border-0 w-100"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; 
                       height: 80px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
                       background-color: #dc3545;">
                    <a href="{{ url('customer/session/track-project-overdue') }}" style="text-decoration: none; color: inherit; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <h5 style="margin-bottom: 8px; font-size: 1rem; font-weight: normal;">Overdue</h5>
                        <h4 id="overdueCount" style="font-size: 1.5rem; font-weight: normal;">0</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    // Fetch data dynamically from Laravel route
    fetch('/chart-data')
        .then(response => response.json())
        .then(data => {
            // Parse the data into Chart.js format
            const labels = ['Pending', 'Delivered', 'In Progress', 'Overdue'];
            const chartData = Object.values(data);

            // Update Progress Summary
            document.getElementById('pendingCount').textContent = chartData[0] || 0;
            document.getElementById('deliveredCount').textContent = chartData[1] || 0;
            document.getElementById('inProgressCount').textContent = chartData[2] || 0;
            document.getElementById('overdueCount').textContent = chartData[3] || 0;

            // Chart.js configuration
            const ctx = document.getElementById('statusChart').getContext('2d');
            const statusChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: chartData,
                        backgroundColor: ['#ffcc00', '#28a745', '#007bff', '#dc3545'],
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                        },
                    },
                    cutout: '70%', // Makes it a donut chart
                    onClick: (event, elements) => {
                        if (elements.length > 0) {
                            const index = elements[0].index; // Get the clicked segment index
                            const status = labels[index]; // Get the corresponding label
                            const count = chartData[index]; // Get the corresponding data
                            alert(`Status: ${status}\nCount: ${count}`);
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching chart data:', error));
</script>

@endsection