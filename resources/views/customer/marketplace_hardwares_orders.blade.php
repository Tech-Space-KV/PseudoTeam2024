
@extends('customer.base_layout')

@section('content')

</br>
<div class="container">
<div class="mb-4">
    <h2>Hardware Deals</h2>
</div>
<div class="search-box-container w-100 mb-4">
  <div class = "mx-auto">
  <Label>Search: </Label>
  <input class="rounded-3" type="text" id="searchCol1" placeholder="Deal ID">
  <input  class="rounded-3" type="text" id="searchCol2" placeholder="H/W Identifier">
  <input  class="rounded-3" type="text" id="searchCol6" placeholder="Status">
  </div>
</div>
</br>


<table class="table table-hover" id="myTable">
    <thead>
      <tr class = "text-pseudo">
        <th scope="col">Deal ID</th>
        <th scope="col">H/W Identifier</th>
        <th scope="col">H/W Model</th>
        <th scope="col">Qty Requested</th>
        <th scope="col">Qty Ordered</th>
        <th scope="col">Status</th>
        <th scope="col">Deal Amt</th>
    </thead>
    <tbody>
      <tr>
        <th scope="row">4</th>
        <td>abcdef8765</td>
        <td>Demo-abc-974</td>
        <td>2</td>
        <td>1</td>
        <td>finalised</td>
        <td>20000</td>
      </tr>
      <tr>
        <th scope="row">31</th>
        <td>abcdeoi98</td>
        <td>Demo-abc-498</td>
        <td>2</td>
        <td>1</td>
        <td>pending</td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">61</th>
        <td>aq1</td>
        <td>Demo-xyz-65</td>
        <td>2</td>
        <td>0</td>
        <td>pending</td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">4</th>
        <td>abcdef8765</td>
        <td>Demo-abc-974</td>
        <td>2</td>
        <td>1</td>
        <td>finalised</td>
        <td>20000</td>
      </tr>
      <tr>
        <th scope="row">31</th>
        <td>abcdeoi98</td>
        <td>Demo-abc-498</td>
        <td>2</td>
        <td>1</td>
        <td>pending</td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">61</th>
        <td>aq1</td>
        <td>Demo-xyz-65</td>
        <td>2</td>
        <td>0</td>
        <td>pending</td>
        <td></td>
      </tr><tr>
        <th scope="row">4</th>
        <td>abcdef8765</td>
        <td>Demo-abc-974</td>
        <td>2</td>
        <td>1</td>
        <td>finalised</td>
        <td>20000</td>
      </tr>
      <tr>
        <th scope="row">31</th>
        <td>abcdeoi98</td>
        <td>Demo-abc-498</td>
        <td>2</td>
        <td>1</td>
        <td>pending</td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">61</th>
        <td>aq1</td>
        <td>Demo-xyz-65</td>
        <td>2</td>
        <td>0</td>
        <td>pending</td>
        <td></td>
      </tr><tr>
        <th scope="row">4</th>
        <td>abcdef8765</td>
        <td>Demo-abc-974</td>
        <td>2</td>
        <td>1</td>
        <td>finalised</td>
        <td>20000</td>
      </tr>
      <tr>
        <th scope="row">31</th>
        <td>abcdeoi98</td>
        <td>Demo-abc-498</td>
        <td>2</td>
        <td>1</td>
        <td>pending</td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">61</th>
        <td>aq1</td>
        <td>Demo-xyz-65</td>
        <td>2</td>
        <td>0</td>
        <td>pending</td>
        <td></td>
      </tr><tr>
        <th scope="row">4</th>
        <td>abcdef8765</td>
        <td>Demo-abc-974</td>
        <td>2</td>
        <td>1</td>
        <td>finalised</td>
        <td>20000</td>
      </tr>
      <tr>
        <th scope="row">31</th>
        <td>abcdeoi98</td>
        <td>Demo-abc-498</td>
        <td>2</td>
        <td>1</td>
        <td>pending</td>
        <td></td>
      </tr>
      <tr>
        <th scope="row">61</th>
        <td>aq1</td>
        <td>Demo-xyz-65</td>
        <td>2</td>
        <td>0</td>
        <td>pending</td>
        <td></td>
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
const searchCol2 = document.getElementById("searchCol2").value.toLowerCase();
const searchCol6 = document.getElementById("searchCol6").value.toLowerCase();

filteredRows = allRows.filter(row => {
  const col1 = row.cells[0].textContent.toLowerCase();
  const col2 = row.cells[1].textContent.toLowerCase();
  const col6 = row.cells[5].textContent.toLowerCase();
  return (
    col1.includes(searchCol1) &&
    col2.includes(searchCol2) &&
    col6.includes(searchCol6)
  );
});

currentPage = 1; // Reset to the first page after filtering
renderTable();
}

// Event listeners for search boxes
document.getElementById("searchCol1").addEventListener("input", filterTable);
document.getElementById("searchCol2").addEventListener("input", filterTable);
document.getElementById("searchCol6").addEventListener("input", filterTable);

// Initial rendering
renderTable();
</script>


@endsection