@extends('customer.base_layout')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<br>
<div class="container  " style="height: 100vh;">

  <div class="mb-4 ">
    <h2>Notifications</h2>
  </div>
    <table class="table table-hover" id="notificationsTable"
        style="background-color: #fff; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <thead class="thead-light" style="background-color: #f9f9f9; border-bottom: 2px solid #ddd;">
            <tr>
                <th scope="col" style="width: 20%; padding: 10px; font-size: 0.9rem; color: #555;">Date</th>
                <th scope="col" style="width: 50%; padding: 10px; font-size: 0.9rem; color: #555;">Notification</th>
                <th scope="col" style="width: 10%; text-align: center; padding: 10px; font-size: 0.9rem; color: #555;">Mark Read</th>
                <th scope="col" style="width: 10%; text-align: center; padding: 10px; font-size: 0.9rem; color: #555;">Mark Unread</th>
                <th scope="col" style="width: 10%; text-align: center; padding: 10px; font-size: 0.9rem; color: #555;">Delete</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 40; $i++) <!-- Generate 40 notifications for testing -->
                <tr style="background-color: #fafafa;">
                    <td style="padding: 15px; font-size: 0.9rem; color: #333;">{{ now()->subDays($i)->format('d/m/Y') }}</td>
                    <td class="notification-text"
                        style="padding: 15px; font-size: 0.9rem; color: #333; line-height: 1.5;">
                        Notification #{{ $i }}: This is a sample notification.
                    </td>
                    <td style="text-align: center; padding: 15px;">
                        <input type="checkbox" class="mark-read"
                            style="width: 20px; height: 20px; cursor: pointer;">
                    </td>
                    <td style="text-align: center; padding: 15px;">
                        <input type="checkbox" class="mark-unread" 
                            style="width: 20px; height: 20px; cursor: pointer;">
                    </td>
                    <td style="text-align: center; padding: 15px;">
                        <button class="btn btn-default btn-sm delete-notification"
                            style="background: none; border: none; color: #007bff; font-size: 1.1rem; cursor: pointer;">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endfor
        </tbody>
    </table>

    <div class="pagination" id="pagination" style="float: right; margin-top: 20px;"></div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const rowsPerPage = 8; // Number of rows per page (changed to 5)
        let currentPage = 1;
        const table = document.getElementById("notificationsTable");
        const tbody = table.querySelector("tbody");
        const pagination = document.getElementById("pagination");
        const allRows = Array.from(tbody.rows); // Store all rows

        // Apply initial styles based on read/unread checkbox state
function applyInitialStyles() {
    allRows.forEach(row => {
        const notificationText = row.querySelector('.notification-text');
        // Set all notifications to bold initially
        notificationText.style.fontWeight = 'bold';
    });
}


        // Render table with pagination
        function renderTable() {
            tbody.innerHTML = ""; // Clear table content
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            allRows.slice(start, end).forEach(row => tbody.appendChild(row));
            applyInitialStyles();
            renderPagination();
        }

        // Render pagination buttons
        function renderPagination() {
            pagination.innerHTML = ""; // Clear existing pagination

            const totalPages = Math.ceil(allRows.length / rowsPerPage);

            // Create pagination buttons
            ['First', 'Previous', ...Array.from({
                length: totalPages
            }, (_, i) => i + 1), 'Next', 'Last']
            .forEach((label) => {
                const button = document.createElement("button");
                button.textContent = label;
                button.className = "btn btn-sm btn-outline-primary mx-1";
                if (label === 'First') button.disabled = currentPage === 1;
                if (label === 'Last') button.disabled = currentPage === totalPages;
                if (label === 'Previous') button.disabled = currentPage === 1;
                if (label === 'Next') button.disabled = currentPage === totalPages;
                button.addEventListener("click", () => {
                    if (label === 'First') currentPage = 1;
                    else if (label === 'Last') currentPage = totalPages;
                    else if (label === 'Previous') currentPage--;
                    else if (label === 'Next') currentPage++;
                    else currentPage = Number(label);
                    renderTable();
                });
                pagination.appendChild(button);
            });
        }

        // Add event listeners for read/unread toggling
        function attachCheckboxListeners() {
            document.querySelectorAll('.mark-read').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const row = this.closest('tr');
                    const unreadCheckbox = row.querySelector('.mark-unread');
                    const notificationText = row.querySelector('.notification-text');
                    if (this.checked) {
                        unreadCheckbox.checked = false; // Uncheck "Unread"
                        notificationText.style.fontWeight = 'normal'; // Set text to normal
                        // alert('Notification marked as read.');
                    }
                });
            });

            document.querySelectorAll('.mark-unread').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const row = this.closest('tr');
                    const readCheckbox = row.querySelector('.mark-read');
                    const notificationText = row.querySelector('.notification-text');
                    if (this.checked) {
                        readCheckbox.checked = false; // Uncheck "Read"
                        notificationText.style.fontWeight = 'bold'; // Set text to bold
                        // alert('Notification marked as unread.');
                    }
                });
            });
        }

        // Add event listeners for delete buttons
        function attachDeleteListeners() {
            document.querySelectorAll('.delete-notification').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const notificationText = row.querySelector('.notification-text').textContent;
                    if (confirm(`Are you sure you want to delete this notification?\n"${notificationText}"`)) {
                        row.remove();
                        // alert('Notification deleted successfully.');
                    }
                });
            });
        }

        // Initial rendering
        renderTable();
        attachCheckboxListeners();
        attachDeleteListeners();
    });
</script>

@endsection