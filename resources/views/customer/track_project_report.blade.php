
@extends('customer.base_layout')

@section('content')

</br>
<div class="container">
<div class="mb-4">
    <h2>Track your project</h2>
</div>
<div class="d-flex justify-content-end">
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
      <!-- <button type="button" class="btn btn-sm btn-outline-primary">CSV</button>
      <button type="button" class="btn btn-sm btn-outline-primary">PDF</button> -->
      <div class="btn-group me-2">
    <a href="{{ route('projects.export.csv') }}" class="btn btn-sm btn-outline-primary">CSV</a>
    <a href="{{ route('projects.export.pdf') }}" class="btn btn-sm btn-outline-primary">PDF</a>
</div>

    </div>
  </div>
</div>

</br> 
<div class="search-box-container w-100 mb-4">
  <div class = "mx-auto">
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
        <th scope="col">Status</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <!-- <tr>
        <th scope="row">100134</th>
        <td>Test Project 1</td>
        <td>28/11/2023</td>
        <td>28/11/2024</td>
        <td>In Progress</td>
        <td ><a href="{{ url('customer/session/track-project-report-location') }}" class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
      </tr>
      <tr>
        <th scope="row">100135</th>
        <td>Test Project 2</td>
        <td>28/11/2023</td>
        <td>28/11/2024</td>
        <td>In Progress</td>
        <td ><a class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
      </tr>
      <tr>
        <th scope="row">100136</th>
        <td>Test Project 3</td>
        <td>28/11/2023</td>
        <td>28/11/2024</td>
        <td>In Progress</td>
        <td ><a class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
      </tr> -->

        <!-- changes made by sanskar -->
        @if($projects->isNotEmpty())
        @foreach($projects as $project)
           <tr>
             <th scope="row">{{ $project->plist_projectid }}</th>
             <td>{{ $project->plist_title }}</td>
             <td>{{ $project->plist_startdate }}</td>
             <td>{{ $project->plist_enddate }}</td>
             <td>{{ $project->plist_status }}</td>
            <td><a href="{{ url('customer/session/track-project-report-location/'.$project->plist_id) }}" class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa fa-location-arrow"></i></a></td> 
            <td><a href="{{ url('customer/session/project-details/'.$project->plist_id) }}"><i class="fa fa-eye btn btn-sm btn-outline-primary"></i></a></td>
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


@endsection
