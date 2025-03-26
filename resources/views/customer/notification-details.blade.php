@extends('customer.base_layout')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <br>
    <div class="container  " style="height: 100vh;">

        <div class="mb-4 ">
            <h2>Notification-details</h2>
        </div>

        <!-- Notification Card -->
        <div class="notification-card"
            style="background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin-bottom: 20px;">
            <div style="font-size: 1.1rem; font-weight: bold; color: #333;">Notification #:
            </div><br>
            <div style="font-size: 1.1rem; font-weight: bold; color: #333;">
                {{ $notification->ntfn_notification }}
            </div><br>
            <div style="font-size: 0.9rem; color: #777; margin-top: 10px;">Date: {{ $notification->ntfn_date_time }}</div>

            <!-- Delete Button -->
            <div style="text-align: right; margin-top: 20px;">
                <button class="btn btn-danger btn-sm" id="deleteNotificationBtn" style="cursor: pointer;">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </div>
        </div>

        <div class="pagination" id="pagination" style="float: right; margin-top: 20px;"></div>
    </div>

    <div class="pagination" id="pagination" style="float: right; margin-top: 20px;"></div>
    </div>


    <!-- sanskar javascript code -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const rowsPerPage = 8; // Number of rows per page
            let currentPage = 1;
            const table = document.getElementById("notificationsTable");
            const tbody = table.querySelector("tbody");
            const pagination = document.getElementById("pagination");
            const allRows = Array.from(tbody.rows);

            // Sort notifications by date in descending order
            allRows.sort((a, b) => {
                const dateA = new Date(a.cells[0].textContent);
                const dateB = new Date(b.cells[0].textContent);
                return dateB - dateA; // Sort in descending order
            });

            // Apply sorted rows to the table
            function renderTable() {
                tbody.innerHTML = "";
                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                allRows.slice(start, end).forEach(row => tbody.appendChild(row));
                renderPagination();
            }

            // Render pagination buttons
            function renderPagination() {
                pagination.innerHTML = "";

                const totalPages = Math.ceil(allRows.length / rowsPerPage);

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

            function attachClickListeners() {
                document.querySelectorAll('.notification-text').forEach(notificationText => {
                    notificationText.addEventListener('click', function () {
                        if (this.style.fontWeight === 'bold') {
                            this.style.fontWeight = 'normal';
                        } else {
                            this.style.fontWeight = 'bold';
                        }
                    });
                });
            }

            function attachDeleteListeners() {
                document.querySelectorAll('.delete-notification').forEach(button => {
                    button.addEventListener('click', function () {
                        const row = this.closest('tr');
                        const notificationText = row.querySelector('.notification-text').textContent;
                        if (confirm(`Are you sure you want to delete this notification?\n"${notificationText}"`)) {
                            row.remove();
                        }
                    });
                });
            }

            // Initial rendering
            renderTable();
            attachClickListeners();
            attachDeleteListeners();
        });
    </script>

@endsection