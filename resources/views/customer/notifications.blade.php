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

                    <th scope="col" style="width: 10%; text-align: center; padding: 10px; font-size: 0.9rem; color: #555;">
                        Delete</th>
                </tr>
            </thead>

            <tbody>

                <!-- @foreach ($notifications as $notification)
                                        <tr class="notification-row" data-id="{{ $notification->ntfn_id }}" style="background-color: #fafafa;">
                                            <td style="padding: 15px; font-size: 0.9rem; color: #333;">{{ $notification->ntfn_date_time }}</td>
                                            <td class="notification-text"
                                                style="padding: 15px; font-size: 0.9rem; color: #333; line-height: 1.5; font-weight: bold; cursor: pointer;"
                                                data-id="{{ $notification->ntfn_id }}">
                                                Notification #: {{ $notification->ntfn_notification }}
                                            </td>
                                            <td style="text-align: center; padding: 15px;">
                                                <button class="btn btn-default btn-sm delete-notification"
                                                    style="background: none; border: none; color: #007bff; font-size: 1.1rem; cursor: pointer;">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach -->

                @if ($notifications->isNotEmpty())
                    @foreach ($notifications as $notification)
                        <tr class="notification-row" data-id="{{ $notification->ntfn_id }}" style="background-color: #fafafa;">
                            <td style="padding: 15px; font-size: 0.9rem; color: #333;">{{ $notification->ntfn_date_time }}</td>
                            <td class="notification-text" style="padding: 15px; font-size: 0.9rem; color: #333; line-height: 1.5; cursor: pointer; 
                                                @if(!$notification->ntfn_readflag) font-weight: bold; @endif"
                                data-id="{{ $notification->ntfn_id }}">
                                Notification #: {{ $notification->ntfn_notification }}
                            </td>
                            <td style="text-align: center; padding: 15px;">
                                <button class="btn btn-default btn-sm delete-notification"
                                    style="background: none; border: none; color: #007bff; font-size: 1.1rem; cursor: pointer;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" style="text-align: center; padding: 15px; font-size: 1rem; color: #555;">
                            No notifications available!
                        </td>
                    </tr>
                @endif


            </tbody>
        </table>

        <div class="pagination" id="pagination" style="float: right; margin-top: 20px;"></div>
    </div>

    <!-- sanskar javascript code -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const rowsPerPage = 8;
            let currentPage = 1;
            const table = document.getElementById("notificationsTable");
            const tbody = table.querySelector("tbody");
            const pagination = document.getElementById("pagination");
            const allRows = Array.from(tbody.rows);

            allRows.sort((a, b) => {
                const dateA = new Date(a.cells[0].textContent);
                const dateB = new Date(b.cells[0].textContent);
                return dateB - dateA;
            });

            function renderTable() {
                tbody.innerHTML = "";
                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                allRows.slice(start, end).forEach(row => tbody.appendChild(row));
                renderPagination();
                attachClickListeners();
            }

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
                        const notificationId = this.getAttribute('data-id');
                        if (notificationId) {
                            window.location.href = `/notification-details/${notificationId}`;
                        } else {
                            console.error('Notification ID not found!');
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

            renderTable();
            attachClickListeners();
            attachDeleteListeners();
        });
    </script>

@endsection