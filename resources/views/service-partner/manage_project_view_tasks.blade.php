<!-- resources/views/customer/page1.blade.php -->
@extends('service-partner.base_layout')

@section('content')


{{-- Your code here --}}
<div class="container">
    <div class="mb-4">
        <h2>Project Timeline: &lt;Project ID&gt;</h2>
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
        <th scope="col">Status</th>
        <th scope="col">Mngr. Status</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
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
      </tr>
    </tbody>
  </table>

  <div class="pagination" style="float:right;" id="pagination"></div>
 
</br>
  <hr class="border border-2 border-secondary">
</br>


<p class="text-pseudo fw-bold">Comments :</p>
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

