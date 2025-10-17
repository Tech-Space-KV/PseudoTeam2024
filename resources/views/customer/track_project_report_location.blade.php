@extends('customer.base_layout')

@section('content')

  </br>
  <div class="container">
    <div class="mb-4">
      <h2 class="fw-bold">Track Your Project - Locations</h2>
    </div>
    </br>

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
    </style>

    <div class="card mb-3">
      <div class="card-body">
        <!-- <h5>Project Completion</h5>
                    <div class="text-muted">Completion: {{ $average }}%</div> -->
        <h4 class="fw-bold mb-2">Overall Location Completion</h4>
        <p class="text-muted mb-1">
          Across all locations in this project: <strong>{{ $average }}%</strong> completed
        </p>

        @php
          $totalCells = 10;
          $filledCells = round($average / 10);
          $visualFilledCells = max($filledCells, 1);

          if ($average <= 30) {
            $fillLevel = 'filled-low';
          } elseif ($average <= 60) {
            $fillLevel = 'filled-mid';
          } else {
            $fillLevel = 'filled-high';
          }
        @endphp

        <div class="battery-bar mt-2">
          @for ($i = 1; $i <= $totalCells; $i++)
            <div class="battery-cell {{ $i <= $visualFilledCells ? $fillLevel : '' }}"></div>
          @endfor
        </div>

        <div class="small text-muted mt-1">{{ $average }}% completed (across all locations)</div>
      </div>
    </div>



    <div class="search-box-container w-100 mb-4">
      <div class="mx-auto">
        <Label>Search: </Label>
        <!-- <input class="rounded-3" type="text" id="searchState" placeholder="State">
          <input class="rounded-3" type="text" id="searchCity" placeholder="City">
          <input class="rounded-3" type="text" id="searchStatus" placeholder="Status"> -->
        <input class="rounded-3" type="text" id="searchState" placeholder="State">
        <input class="rounded-3" type="text" id="searchCity" placeholder="City">
        <input class="rounded-3" type="text" id="searchStatus" placeholder="Status">
      </div>
    </div>
    </br>
    <table class="table table-hover" id="myTable">
      <thead>
        <tr class="text-pseudo">
          {{-- <th scope="col">Proj. ID.</th>
          <th scope="col">Title</th> --}}
          <th scope="col">Country</th>
          <!-- <th scope="col">End Date</th> -->
          <th scope="col">State</th>
          <th scope="col">City</th>
          <th scope="col">Status</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <!-- <tr>
                      {{-- <th scope="row">100134</th>
                      <td>Test Project 1</td> --}}
                      <td>Location: city, state, country, pincode</td>
                      <td>28/11/2023</td>
                      <td>28/11/2024</td>
                      <td>In Progress</td>
                      <td ><a href="{{ url('customer/session/track-project-report-details') }}" class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    <tr>
                      {{-- <th scope="row">100135</th>
                      <td>Test Project 2</td> --}}
                      <td>Location: city, state, country, pincode</td>
                      <td>28/11/2023</td>
                      <td>28/11/2024</td>
                      <td>In Progress</td>
                      <td ><a class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    <tr>
                      {{-- <th scope="row">100136</th>
                      <td>Test Project 3</td> --}}
                      <td>Location: city, state, country, pincode</td>
                      <td>28/11/2023</td>
                      <td>28/11/2024</td>
                      <td>In Progress</td>
                      <td ><a class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
                    </tr> -->
        @if ($project_scope->isNotEmpty())
          @foreach ($project_scope as $pscope)

            <tr>
              <td>{{ $pscope->pscope_country ?: 'No country available' }}</td>
              <td>{{ $pscope->pscope_state ?: 'No state available' }}</td>
              <td>{{ $pscope->pscope_city ?: 'No city available' }}</td>
              <td>{{ $pscope->pscope_status ?: 'No status available' }}</td>
              <td>
                <a href="{{ url('customer/session/track-project-report-details/' . $pscope->pscope_id)}}"
                  class="btn btn-sm btn-outline-primary" title="Track Progress">
                  <i class="fa fa fa-location-arrow"></i>
                </a>
              </td>
            </tr>

          @endforeach
        @else
          <tr>
            <td colspan="6" class="text-center">No projects found!.</td>
          </tr>
        @endif

      </tbody>
    </table>

    <div class="pagination" style="float:right;" id="pagination"></div>


  </div>

  <script>
    const rowsPerPage = 10; // Number of rows per page
    let currentPage = 1;
    const table = document.getElementById("myTable");
    const tbody = table.querySelector("tbody");
    const pagination = document.getElementById("pagination");
    let allRows = Array.from(tbody.rows); // Store all rows initially
    let filteredRows = [...allRows]; // Start with all rows included

    // Function to render the table with pagination
    function renderTable() {
      // Clear table
      tbody.innerHTML = "";
      // Calculate start and end index
      const start = (currentPage - 1) * rowsPerPage;
      const end = start + rowsPerPage;
      // Add rows to the table for the current page
      filteredRows.slice(start, end).forEach(row => tbody.appendChild(row));
      renderPagination();
    }
    // Function to render pagination buttons
    function renderPagination() {
      pagination.innerHTML = ""; // Clear existing pagination

      const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

      // Create "First" button
      const firstButton = document.createElement("button");
      firstButton.textContent = "First";
      firstButton.className = "btn btn-sm btn-outline-primary mx-1";
      firstButton.disabled = currentPage === 1; // Disable if already on the first page
      firstButton.addEventListener("click", () => {
        currentPage = 1;
        renderTable();
      });
      pagination.appendChild(firstButton);

      // Create "Previous" button
      const prevButton = document.createElement("button");
      prevButton.textContent = "Previous";
      prevButton.className = "btn btn-sm btn-outline-primary mx-1";
      prevButton.disabled = currentPage === 1; // Disable if already on the first page
      prevButton.addEventListener("click", () => {
        currentPage = Math.max(1, currentPage - 1); // Move to the previous page
        renderTable();
      });
      pagination.appendChild(prevButton);

      // Create page number buttons
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

      // Create "Next" button
      const nextButton = document.createElement("button");
      nextButton.textContent = "Next";
      nextButton.className = "btn btn-sm btn-outline-primary mx-1";
      nextButton.disabled = currentPage === totalPages; // Disable if already on the last page
      nextButton.addEventListener("click", () => {
        currentPage = Math.min(totalPages, currentPage + 1); // Move to the next page
        renderTable();
      });
      pagination.appendChild(nextButton);

      // Create "Last" button
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

    // Function to filter the table
    // function filterTable() {
    //   const searchCol2 = document.getElementById("searchCol2").value.toLowerCase();
    //   const searchCol3 = document.getElementById("searchCol3").value.toLowerCase();
    //   const searchCol4 = document.getElementById("searchCol4").value.toLowerCase();

    //   filteredRows = allRows.filter(row => {
    //     const col2 = row.cells[0].textContent.toLowerCase();
    //     const col3 = row.cells[1].textContent.toLowerCase();
    //     const col4 = row.cells[4].textContent.toLowerCase();
    //     return (
    //       col2.includes(searchCol2) &&
    //       col3.includes(searchCol3) &&
    //       col4.includes(searchCol4)
    //     );
    //   });

    //   currentPage = 1; // Reset to the first page after filtering
    //   renderTable();
    // }

    // // Event listeners for search boxes
    // document.getElementById("searchCol2").addEventListener("input", filterTable);
    // document.getElementById("searchCol3").addEventListener("input", filterTable);
    // document.getElementById("searchCol4").addEventListener("input", filterTable);

    // // Initial rendering
    // renderTable();
  </script>

  <script>
    function filterTable() {
      const searchState = document.getElementById("searchState").value.toLowerCase();
      const searchCity = document.getElementById("searchCity").value.toLowerCase();
      const searchStatus = document.getElementById("searchStatus").value.toLowerCase();

      filteredRows = allRows.filter(row => {
        const state = row.cells[1].textContent.toLowerCase();  // State
        const city = row.cells[2].textContent.toLowerCase();   // City
        const status = row.cells[3].textContent.toLowerCase(); // Status

        return (
          state.includes(searchState) &&
          city.includes(searchCity) &&
          status.includes(searchStatus)
        );
      });

      currentPage = 1;
      renderTable();
    }

    // Event listeners
    document.getElementById("searchState").addEventListener("input", filterTable);
    document.getElementById("searchCity").addEventListener("input", filterTable);
    document.getElementById("searchStatus").addEventListener("input", filterTable);
  </script>



@endsection