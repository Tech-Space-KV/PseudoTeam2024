
@extends('customer.base_layout')

@section('content')

</br>
<div class="container">
<div class="mb-4">
    <h2>Hardware List</h2>
</div>
<div class="search-box-container w-100 mb-4">
  <div class = "mx-auto">
  <Label>Search: </Label>
  <input class="rounded-3" type="text" id="searchCol1" placeholder="Serial No">
  <input  class="rounded-3" type="text" id="searchCol2" placeholder="H/W Identifier">
  <input  class="rounded-3" type="text" id="searchCol5" placeholder="Family">
  </div>
</div>
</br>


<table class="table table-hover" id="myTable">
    <thead>
      <tr class = "text-pseudo">
        <th scope="col">Serial No</th>
        <th scope="col">H/W Identifier</th>
        <th scope="col">Model No</th>
        <th scope="col">Qty</th>
        <th scope="col">Family</th>
        <th scope="col">City</th>
        <th scope="col">State</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">123</th>
        <td>aq1</td>
        <td>zaq1</td>
        <td>2</td>
        <td>cde1</td>
        <td>Delhi</td>
        <td>Delhi</td>
        <td ><a class="btn btn-sm btn-outline-primary" title="View H/W Details">View</a></td>
      </tr>
      <tr>
        <th scope="row">124</th>
        <td>aq1</td>
        <td>zaq1</td>
        <td>2</td>
        <td>cde1</td>
        <td>Delhi</td>
        <td>Delhi</td>
        <td ><a class="btn btn-sm btn-outline-primary" title="View H/W Details">View</a></td>
      </tr>
      <tr>
        <th scope="row">127</th>
        <td>aq1</td>
        <td>zaq1</td>
        <td>2</td>
        <td>cde1</td>
        <td>Delhi</td>
        <td>Delhi</td>
        <td ><a class="btn btn-sm btn-outline-primary" title="View H/W Details">View</a></td>
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
const searchCol1 = document.getElementById("searchCol1").value.toLowerCase();
const searchCol2 = document.getElementById("searchCol2").value.toLowerCase();
const searchCol5 = document.getElementById("searchCol5").value.toLowerCase();

filteredRows = allRows.filter(row => {
  const col1 = row.cells[0].textContent.toLowerCase();
  const col2 = row.cells[1].textContent.toLowerCase();
  const col5 = row.cells[4].textContent.toLowerCase();
  return (
    col1.includes(searchCol1) &&
    col2.includes(searchCol2) &&
    col5.includes(searchCol5)
  );
});

currentPage = 1; // Reset to the first page after filtering
renderTable();
}

// Event listeners for search boxes
document.getElementById("searchCol1").addEventListener("input", filterTable);
document.getElementById("searchCol2").addEventListener("input", filterTable);
document.getElementById("searchCol5").addEventListener("input", filterTable);

// Initial rendering
renderTable();
</script>


@endsection