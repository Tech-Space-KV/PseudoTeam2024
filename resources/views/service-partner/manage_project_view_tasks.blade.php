<!-- resources/views/customer/page1.blade.php -->
@extends('service-partner.base_layout')

@section('content')


  {{-- Your code here --}}
  <div class="container">
    <div class="mb-4">
    <h2>Project Tasks</h2>
    </div>
    </br>


    </br>
    <table class="table table-hover" id="myTable">
    <thead>
      <tr class="text-pseudo">
      <th scope="col">Task</th>
      <th scope="col">Description</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col">SP Status</th>
      <th scope="col">Mngr. Status</th>
      <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <!-- <tr>
      <td>Need to rewamp the pseudoteam project</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>On site</td>
      <td ><a href="{{ url('service-partner/session/manage_project_edit_task') }}" class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
      </tr>
      <tr>
      <td>Customer Dashboard</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>On site</td>
       <td> <a href="{{ url('service-partner/session/manage_project_edit_task') }}" class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
      </tr>
      <tr>
      <td>Marketplace Functionality</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>On site</td>
       <td> <a href="{{ url('service-partner/session/manage_project_edit_task') }}" class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
      </tr> -->

      @foreach ($projectPlannerTasks as $ppTask)
      <tr>
      <td>{{$ppTask->pptasks_task_title }}</td>
      <td>{{$ppTask->pptasks_description }}</td>
      <td>{{$ppTask->pptasks_start_date }}</td>
      <td>{{$ppTask->pptasks_end_date }}</td>
      <td>{{$ppTask->pptasks_sp_status }}</td>
      <td>{{$ppTask->pptasks_pt_status }}</td>
      <td>
      <a href="{{ url('service-partner/session/manage_project_edit_task/' . $ppTask->pptasks_id) }}"
      class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a>
      </td>
      </tr>

    @endforeach

    </tbody>
    </table>

    <div class="pagination" style="float:right;" id="pagination"></div>

    <!-- </br>
    <hr class="border border-2 border-secondary">
    </br> -->


    <!-- <p class="text-pseudo fw-bold">Comments :</p>
    <div class="w-100 p-2" style="height: 400px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">

    <div class="card p-2 mb-2">
      <textarea class="p-2" placeholder="Write a comment"></textarea>
      <button class="btn btn-sm btn-outline-primary mt-1 w-25">Post</button>
    </div>

    <div class="card p-2 mb-2">
      <p class="fw-bold">username :</p>
      <p>Dummy content line 1</p>
    </div>
    <div class="card p-2 mb-2">
      <p class="fw-bold">username :</p>
      <p>Dummy content line 1</p>
    </div>
    <div class="card p-2 mb-2">
      <p class="fw-bold">username :</p>
      <p>Dummy content line 1</p>
    </div>
    <div class="card p-2 mb-2">
      <p class="fw-bold">username :</p>
      <p>Dummy content line 1</p>
    </div>
    <div class="card p-2 mb-2">
      <p class="fw-bold">username :</p>
      <p>Dummy content line 1</p>
    </div>
    <div class="card p-2 mb-2">
      <p class="fw-bold">username :</p>
      <p>Dummy content line 1</p>
    </div>
    <div class="card p-2 mb-2">
      <p class="fw-bold">username :</p>
      <p>Dummy content line 1</p>
    </div>
    <div class="card p-2 mb-2">
      <p class="fw-bold">username :</p>
      <p>Dummy content line 1</p>
    </div>

    </div> -->
    </br></br>

  </div>

  <script>
    const rowsPerPage = 10;
    let currentPage = 1;
    const table = document.getElementById("myTable");
    const tbody = table.querySelector("tbody");
    const pagination = document.getElementById("pagination");
    const allRows = Array.from(tbody.rows);

    function renderTable() {
    tbody.innerHTML = "";
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    allRows.slice(start, end).forEach(row => tbody.appendChild(row));
    renderPagination();
    }

    function renderPagination() {
    pagination.innerHTML = "";

    const totalPages = Math.ceil(allRows.length / rowsPerPage);

    const firstButton = document.createElement("button");
    firstButton.textContent = "First";
    firstButton.className = "btn btn-sm btn-outline-primary mx-1";
    firstButton.disabled = currentPage === 1;
    firstButton.addEventListener("click", () => {
      currentPage = 1;
      renderTable();
    });
    pagination.appendChild(firstButton);

    const prevButton = document.createElement("button");
    prevButton.textContent = "Previous";
    prevButton.className = "btn btn-sm btn-outline-primary mx-1";
    prevButton.disabled = currentPage === 1;
    prevButton.addEventListener("click", () => {
      currentPage = Math.max(1, currentPage - 1);
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
    nextButton.disabled = currentPage === totalPages;
    nextButton.addEventListener("click", () => {
      currentPage = Math.min(totalPages, currentPage + 1);
      renderTable();
    });
    pagination.appendChild(nextButton);

    const lastButton = document.createElement("button");
    lastButton.textContent = "Last";
    lastButton.className = "btn btn-sm btn-outline-primary mx-1";
    lastButton.disabled = currentPage === totalPages;
    lastButton.addEventListener("click", () => {
      currentPage = totalPages;
      renderTable();
    });
    pagination.appendChild(lastButton);
    }

    document.addEventListener("DOMContentLoaded", function () {
    renderTable();
    });
  </script>

@endsection