
@extends('customer.base_layout')

@section('content')

</br>
<div class="container">
<div class="mb-4">
    <h2>Track your project</h2>
</div>
</br> 

<div class="chart-container" style="width: 40%">
  <canvas id="statusChart"></canvas>
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
                          const status = labels[index];  // Get the corresponding label
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
