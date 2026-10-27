@extends('customer.base_layout')

@section('content')

  </br>
  <div class="container">
    <div class="mb-4">
      <h2 class="fw-bold">Track Your Project</h2>
    </div>

    <style>
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
        /* Default empty */
        transition: background-color 0.3s ease;
      }

      .battery-cell.filled-low {
        background-color: #dc3545;
        /* Red */
      }

      .battery-cell.filled-mid {
        background-color: #ffc107;
        /* Yellow */
      }

      .battery-cell.filled-high {
        background-color: #0d6efd;
        /* Blue */
      }

      .speedometer-wrapper {
        position: absolute;
        top: 5px;
        right: 10px;
        width: 100px;
        height: 60px;
      }

      .speedometer-svg {
        width: 100%;
        height: 100%;
      }

      .needle {
        stroke: red;
        stroke-width: 3;
        transform-origin: 100px 100px;
        transform: rotate(-90deg);
        transition: transform 0.3s ease-in-out;
      }
    </style>


<style>
.circular-ring {
  --size: 42px;          /* diameter */
  --thickness: 5px;      /* ring thickness */
  --progress: 0;         /* dynamic value (0–100) */

  width: var(--size);
  height: var(--size);
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;

  /* ORANGE RING */
  background: conic-gradient(#ff8c00 calc(var(--progress) * 1%), #e6e6e6 0);
  position: relative;
  transition: background 0.45s cubic-bezier(.2,.8,.2,1);
}

/* inner circle */
.circular-ring .inner {
  width: calc(var(--size) - (var(--thickness) * 2));
  height: calc(var(--size) - (var(--thickness) * 2));
  border-radius: 50%;
  background: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* percentage text */
.circular-ring .value {
  font-size: 10px;
  font-weight: 600;
  color: #ff8c00;      /* ORANGE TEXT */
  user-select: none;
}

/* small responsive tweak so the cell doesn't shrink too much */
.table td.progress-cell {
  white-space: nowrap;
  vertical-align: middle;
}
</style>


    <div class="d-flex justify-content-end">
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          
          <div class="btn-group me-2">
           
            <a href="{{ route('projects.export.comprehensive') }}" class="btn btn-sm btn-outline-primary">Projects
              Overview</a>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#selectProjectModal">
              Project Report
            </button>
          </div>
        </div>
      </div>
    </div>

    </br>
    <div class="search-box-container w-100 mb-4">
      <div class="mx-auto">
        <Label>Search: </Label>
        <input class="rounded-3" type="text" id="searchCol2" placeholder="Proj. ID.">
        <input class="rounded-3" type="text" id="searchCol3" placeholder="Title">
        <input class="rounded-3" type="text" id="searchCol4" placeholder="Status">
      </div>
    </div>
    </br>
    <table class="table table-hover" id="myTable">
      <thead>
        <tr class="text-pseudo">
          <th scope="col">Proj. ID.</th>
          <th scope="col">Title</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
              @if(!empty($showDeliveredColumn) && $showDeliveredColumn)
      <th scope="col">Delivered On</th>
    @endif
          <!-- <th scope="col">Status</th> -->
          <th scope="col">Completed Progress</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>

        <!-- changes made by sanskar -->
        @if($projects->isNotEmpty())
          @foreach($projects as $project)
            <tr>
              <th scope="row">{{ $project->plist_projectid }}</th>
              <td>{{ $project->plist_title }}</td>
              <td>{{ $project->plist_startdate }}</td>
              <td>{{ $project->plist_enddate }}</td>
              {{-- Conditionally display Delivered On column --}}
@if(!empty($showDeliveredColumn) && $showDeliveredColumn)
  <td>
    @php
      // Use plist_delivered_on column (exists in your DB)
      $deliveredOnRaw = $project->plist_delivered_on ?? null;
      $deliveredOn = null;

      if ($deliveredOnRaw) {
          try {
              // Attempt to parse flexible date strings using Carbon
              $dt = \Carbon\Carbon::parse($deliveredOnRaw);
              // Format as day-month-year (change if you prefer)
              $deliveredOn = $dt->format('d-m-Y');
          } catch (\Exception $e) {
              // If parsing fails, show raw string
              $deliveredOn = $deliveredOnRaw;
          }
      }
    @endphp

    @if($deliveredOn)
      <span class="text-success">{{ $deliveredOn }}</span>
    @else
      {{-- If no delivered-on value is stored, show Delivered badge --}}
      <span class="badge bg-success">Delivered</span>
    @endif
  </td>
@endif

              <td>
  @php
    // get numeric progress value and clamp 0..100
    $raw = $project->average_completion ?? 0;
    $progress = is_numeric($raw) ? (float)$raw : 0;
    $progress = max(0, min(100, $progress));

    // choose size class if you want: sm | md | lg (default md)
    $sizeClass = 'md';
  @endphp

  <div class="circular-ring {{ $sizeClass }}" 
       style="--progress: {{ $progress }};"
       role="img" aria-label="Project progress {{ $progress }} percent"
       aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">

    <div class="inner">
      <div class="value">{{ $progress }}%</div>
    </div>
  </div>
</td>

              <td>
                <a href="{{ url('customer/session/track-project-report-location/' . $project->plist_id) }}"
                  class="btn btn-sm btn-outline-primary" title="Track Progress">
                  <i class="fa fa-location-arrow"></i>
                </a>
              </td>

              <!-- Project details icon -->
              <td>
                <a href="{{ url('customer/session/project-details/' . $project->plist_id) }}"
                  class="btn btn-sm btn-outline-primary" title="Project Details">
                  <i class="fa fa-folder-open"></i>
                </a>
              </td>

          @endforeach
        @else
            <tr>
              <td colspan="6" class="text-center">No projects found!.</td>
            </tr>
          @endif

      </tbody>
    </table>

    <div class="pagination" style="float:right;" id="pagination"></div>

    <!-- Select Project Modal -->
    <div class="modal fade" id="selectProjectModal" tabindex="-1" aria-labelledby="selectProjectModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="selectProjectModalLabel">Select Project</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="{{ route('projects.export.individual') }}" method="POST">
            @csrf

            <div class="modal-body">
              <label class="mb-2 fw-bold">Choose a project:</label>
              <select name="project_id" class="form-select" required>
                <option value="" selected disabled>Select a project</option>

                @foreach($projects as $project)
                  <option value="{{ $project->plist_id }}">
                    {{ $project->plist_projectid }} — {{ $project->plist_title }}
                  </option>
                @endforeach

              </select>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Download Report</button>
            </div>

          </form>

        </div>
      </div>
    </div>


  </div>

  <script>
    const rowsPerPage = 10;
    let currentPage = 1;
    const table = document.getElementById("myTable");
    const tbody = table.querySelector("tbody");
    const pagination = document.getElementById("pagination");
    let allRows = Array.from(tbody.rows);
    let filteredRows = [...allRows];


    function renderTable() {

      tbody.innerHTML = "";

      const start = (currentPage - 1) * rowsPerPage;
      const end = start + rowsPerPage;

      filteredRows.slice(start, end).forEach(row => tbody.appendChild(row));
      renderPagination();
    }

    function renderPagination() {
      pagination.innerHTML = "";

      const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

      const firstButton = document.createElement("button");
      firstButton.textContent = "First";
      firstButton.className = "btn btn-sm btn-outline-primary mx-1";
      firstButton.disabled = currentPage === 1; // Disable if already on the first page
      firstButton.addEventListener("click", () => {
        currentPage = 1;
        renderTable();
      });
      pagination.appendChild(firstButton);


      const prevButton = document.createElement("button");
      prevButton.textContent = "Previous";
      prevButton.className = "btn btn-sm btn-outline-primary mx-1";
      prevButton.disabled = currentPage === 1; // Disable if already on the first page
      prevButton.addEventListener("click", () => {
        currentPage = Math.max(1, currentPage - 1); // Move to the previous page
        renderTable();
      });
      pagination.appendChild(prevButton);


      for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement("button");
        button.textContent = i;
        button.className = i === currentPage ? "active btn btn-sm btn-outline-primary mx-1" : "btn btn-sm btn-outline-primary mx-1";
        button.addEventListener("click", () => {
          currentPage = i;
          renderTable();
        });
        pagination.appendChild(button);
      }


      const nextButton = document.createElement("button");
      nextButton.textContent = "Next";
      nextButton.className = "btn btn-sm btn-outline-primary mx-1";
      nextButton.disabled = currentPage === totalPages; // Disable if already on the last page
      nextButton.addEventListener("click", () => {
        currentPage = Math.min(totalPages, currentPage + 1); // Move to the next page
        renderTable();
      });
      pagination.appendChild(nextButton);


      const lastButton = document.createElement("button");
      lastButton.textContent = "Last";
      lastButton.className = "btn btn-sm btn-outline-primary mx-1";
      lastButton.disabled = currentPage === totalPages; // Disable if already on the last page
      lastButton.addEventListener("click", () => {
        currentPage = totalPages;
        renderTable();
      });
      pagination.appendChild(lastButton);
    }


    function filterTable() {
      const searchCol2 = document.getElementById("searchCol2").value.toLowerCase();
      const searchCol3 = document.getElementById("searchCol3").value.toLowerCase();
      const searchCol4 = document.getElementById("searchCol4").value.toLowerCase();

      filteredRows = allRows.filter(row => {
        const col2 = row.cells[0].textContent.toLowerCase();
        const col3 = row.cells[1].textContent.toLowerCase();
        const col4 = row.cells[4].textContent.toLowerCase();
        return (
          col2.includes(searchCol2) &&
          col3.includes(searchCol3) &&
          col4.includes(searchCol4)
        );
      });

      currentPage = 1;
      renderTable();
    }


    document.getElementById("searchCol2").addEventListener("input", filterTable);
    document.getElementById("searchCol3").addEventListener("input", filterTable);
    document.getElementById("searchCol4").addEventListener("input", filterTable);

    renderTable();
  </script>

  <script>
    function setProgress(percent) {
      const needle = document.getElementById('needle');
      const clamped = Math.max(0, Math.min(100, percent));
      const angle = -90 + (clamped * 180 / 100);
      needle.style.transform = `rotate(${angle}deg)`;
    }

    // Set based on actual progress
    setProgress({{ $overallAverage ?? 0 }});
  </script>



@endsection