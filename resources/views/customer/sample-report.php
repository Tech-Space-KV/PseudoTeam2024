
@extends('customer.base_layout')

@section('content')

</br>
<div class="container">
<div class="mb-4">
    <h2>Track your project</h2>
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
      <tr>
        <th scope="row">100134</th>
        <td>Test Project 1</td>
        <td>28/11/2023</td>
        <td>28/11/2024</td>
        <td>In Progress</td>
        <td ><a class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
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
      </tr>
    </tbody>
  </table>

  <div class="pagination" id="pagination"></div>
 

</div>

<script>
const rowsPerPage = 5; // Number of rows per page
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
pagination.innerHTML = "";
const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

for (let i = 1; i <= totalPages; i++) {
  const button = document.createElement("button");
  button.textContent = i;
  button.className = i === currentPage ? "active" : "";
  button.classList.add("btn btn-sm btn-primary"); 
  button.addEventListener("click", () => {
    currentPage = i;
    renderTable();
  });
  pagination.appendChild(button);
}
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