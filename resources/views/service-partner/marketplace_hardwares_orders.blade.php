
@extends('service-partner.base_layout')

@section('content')

</br>
<div class="container">
<div class="mb-4">
    <h2>Order History</h2>
</div>
<div class="search-box-container w-100 mb-4">
  <div class = "mx-auto">
  <Label>Search: </Label>
  <input class="rounded-3" type="text" id="searchCol1" placeholder="Order No">
  <input  class="rounded-3" type="text" id="searchCol3" placeholder="Order Date">
  <input  class="rounded-3" type="text" id="searchCol4" placeholder="Status">
  </div>
</div>
</br>


<table class="table table-hover" id="myTable">
    <thead>
      <tr class = "text-pseudo">
        <th scope="col">Order No</th>
        <th scope="col">No. of items</th>
        <th scope="col">Ordered On</th>
        <th scope="col">Status</th>
        <th scope="col">Amount</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">123</th>
        <td>3</td>
        <td>28/11/2023</td>
        <td>Pending</td>
        <td>20000</td>
        <td ><a href="{{ url('/service-partner/session/hardware-details') }}" class="btn btn-sm btn-outline-primary" title="View H/W Details">View</a></td>
      </tr>
      <tr>
        <th scope="row">124</th>
        <td>5</td>
        <td>17/12/2023</td>
        <td>Finalized</td>
        <td>30000</td>
        <td ><a href="{{ url('/service-partner/session/hardware-details') }}" class="btn btn-sm btn-outline-primary" title="View H/W Details">View</a></td>
      </tr>
      <tr>
        <th scope="row">127</th>
        <td>9</td>
        <td>07/09/2024</td>
        <td>Pending</td>
        <td>15000</td>
        <td ><a href="{{ url('/service-partner/session/hardware-details') }}" class="btn btn-sm btn-outline-primary" title="View H/W Details">View</a></td>
      </tr>
      <tr>
        <th scope="row">123</th>
        <td>10</td>
        <td>08/10/2024</td>
        <td>Pending</td>
        <td>25000</td>
        <td ><a href="{{ url('/service-partner/session/hardware-details') }}" class="btn btn-sm btn-outline-primary" title="View H/W Details">View</a></td>
      </tr>
      <tr>
        <th scope="row">124</th>
        <td>4</td>
        <td>20/11/2024</td>
        <td>Finalized</td>
        <td>18000</td>
        <td ><a href="{{ url('/service-partner/session/hardware-details') }}" class="btn btn-sm btn-outline-primary" title="View H/W Details">View</a></td>
      </tr>
      <tr>
        <th scope="row">127</th>
        <td>6</td>
        <td>17/12/2024</td>
        <td>Pending</td>
        <td>21000</td>
        <td ><a href="{{ url('/service-partner/session/hardware-details') }}" class="btn btn-sm btn-outline-primary" title="View H/W Details">View</a></td>
      </tr>
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
function filterTable() {
const searchCol1 = document.getElementById("searchCol1").value.toLowerCase();
const searchCol3 = document.getElementById("searchCol3").value.toLowerCase();
const searchCol4 = document.getElementById("searchCol4").value.toLowerCase();

filteredRows = allRows.filter(row => {
  const col1 = row.cells[0].textContent.toLowerCase();
  const col3 = row.cells[2].textContent.toLowerCase();
  const col4 = row.cells[3].textContent.toLowerCase();
  return (
    col1.includes(searchCol1) &&
    col3.includes(searchCol3) &&
    col4.includes(searchCol4)
  );
});

currentPage = 1; // Reset to the first page after filtering
renderTable();
}

// Event listeners for search boxes
document.getElementById("searchCol1").addEventListener("input", filterTable);
document.getElementById("searchCol3").addEventListener("input", filterTable);
document.getElementById("searchCol4").addEventListener("input", filterTable);

// Initial rendering
renderTable();
</script>


@endsection
