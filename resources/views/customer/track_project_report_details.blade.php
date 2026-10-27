@extends('customer.base_layout')

@section('content')

  </br>
  <div class="container">

    <!-- <div class="mb-4">
            <h2 class="fw-bold">Track Your Project - Milestones</h2>
          </div> -->

    <div class="mb-4 d-flex align-items-center">
      @if(isset($projectScope))
        <a href="{{ url('customer/session/track-project-report-location/' . $projectScope->pscope_project_id) }}"
          class="btn btn-outline-primary btn-sm me-2">
          <i class="fa fa-arrow-left"></i>
        </a>
      @else
        <a href="{{ url('customer/session/track-project-report') }}" class="btn btn-outline-primary btn-sm me-2">
          <i class="fa fa-arrow-left"></i>
        </a>
      @endif

      <h2 class="fw-bold mb-0">Track Your Project - Milestones</h2>
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
    </style>

    <style>
      .circular-ring {
        --size: 42px;
        --thickness: 5px;
        --progress: 0;

        width: var(--size);
        height: var(--size);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;

        background: conic-gradient(#ff8c00 calc(var(--progress) * 1%),
            #e6e6e6 0);

        position: relative;
      }

      .circular-ring .inner {
        width: calc(var(--size) - (var(--thickness) * 2));
        height: calc(var(--size) - (var(--thickness) * 2));
        border-radius: 50%;
        background: #fff;

        display: flex;
        align-items: center;
        justify-content: center;
      }

      .circular-ring .value {
        font-size: 10px;
        font-weight: 600;
        color: #ff8c00;
      }
    </style>

    </br>
    </br>
    <div>
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
            {{-- <th scope="col">Proj. ID.</th>
            <th scope="col">Title</th> --}}
            <th scope="col">Milestone</th>
            <th scope="col">Description</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Status</th>
            <th scope="col">Progress</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @if($project_planner->isNotEmpty())
            @foreach ($project_planner as $pp)


              <tr>
                <td>{{ $pp->pplnr_milestone }}</td>
                <td>{{ $pp->pplnr_description }}</td>
                <td>{{ $pp->pplnr_start_date }}</td>
                <td>{{ $pp->pplnr_end_date }}</td>
                <td>{{ $pp->pplnr_status }}</td>

                <td>
                  @php
                    $progress = (float) ($pp->progress ?? 0);
                    $progress = max(0, min(100, $progress));
                  @endphp

                  <div class="circular-ring" style="--progress: {{ $progress }};">
                    <div class="inner">
                      <div class="value">{{ $progress }}%</div>
                    </div>
                  </div>
                </td>

                <td>
                  <a href="{{ url('customer/session/project-timeline/' . $pp->pplnr_id) }}"
                    class="btn btn-sm btn-outline-primary" title="Track Progress">
                    <i class="fa fa-location-arrow"></i>
                  </a>
                </td>
              </tr>

            @endforeach
          @else
            <tr>
              <td colspan="6" class="text-center">No milestones found!.</td>
            </tr>
          @endif

        </tbody>
      </table>

      <div class="pagination" style="float:right;" id="pagination"></div>
    </div>
    </br>
    <hr class="border border-2 border-secondary">
    </br>


    @if($project_planner->isNotEmpty())
      <p class="text-pseudo fw-bold">Comments :</p>

      <div class="w-100 p-2" style="height: 400px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">

        {{-- Add Comment --}}
        <div class="card p-2 mb-2">
          <form action="{{ route('comment.store') }}" method="POST">
            @csrf

            <input type="hidden" name="pconv_comment_by_cust_id" value="{{ session('user_id') }}">

            <input type="hidden" name="pconv_scope_id" value="{{ $project_planner->first()->pplnr_scope_id }}">

            <textarea class="p-2 w-100" placeholder="Write a comment" name="pconv_comment" required></textarea>

            <input type="submit" class="btn btn-sm btn-outline-primary mt-1 w-25" value="Post">
          </form>
        </div>

        {{-- Comments List --}}
        @if($comments->isEmpty())

          <p>No comments yet.</p>

        @else

          @foreach ($comments as $comment)

            <div class="card p-2 mb-2">

              <div class="d-flex justify-content-between align-items-center">

                <p class="fw-bold mb-1">
                  {{ $comment->pconv_comment_by_cust_id }}
                </p>

                @if($comment->pconv_comment_by_cust_id == session('user_id'))

                  <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#editComment{{ $comment->pconv_id }}">
                    Edit
                  </button>

                @endif

              </div>

              <p>{{ $comment->pconv_comment }}</p>

              <p class="text-muted mb-1">
                {{ $comment->pconv_comment_date_time }}
              </p>

              {{-- Edit Form --}}
              @if($comment->pconv_comment_by_cust_id == session('user_id'))

                <div class="collapse mt-2" id="editComment{{ $comment->pconv_id }}">

                  <form action="{{ route('comment.update', $comment->pconv_id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <textarea name="pconv_comment" class="form-control mb-2" rows="3"
                      required>{{ $comment->pconv_comment }}</textarea>

                    <button type="submit" class="btn btn-success btn-sm">
                      Update Comment
                    </button>

                  </form>

                </div>

              @endif

            </div>

          @endforeach

        @endif

      </div>
    @endif

  </div>
  </br></br>

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

      currentPage = 1; // Reset to the first page after filtering
      renderTable();
    }

    // Event listeners for search boxes
    document.getElementById("searchCol2").addEventListener("input", filterTable);
    document.getElementById("searchCol3").addEventListener("input", filterTable);
    document.getElementById("searchCol4").addEventListener("input", filterTable);

    // Initial rendering
    renderTable();
  </script>


@endsection