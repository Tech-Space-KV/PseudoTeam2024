@extends('customer.base_layout')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- 🟡 CSRF TOKEN --}}
    <br>

    <div class="container" style="height: 100vh;">
        <div class="mb-4">
            <h2 class="fw-bold">Notifications</h2>
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
                @if ($notifications->isNotEmpty())
                    @foreach ($notifications as $notification)
                        <tr class="notification-row" data-id="{{ $notification->ntfn_id }}" style="background-color: #fafafa;">
                            <td style="padding: 15px; font-size: 0.9rem; color: #333;">{{ $notification->ntfn_date_time }}</td>
                            <td class="notification-text" data-id="{{ $notification->ntfn_id }}" style="padding: 15px; font-size: 0.9rem; color: #333; line-height: 1.5; cursor: pointer;
                                            @if(!$notification->ntfn_readflag) font-weight: bold; @endif">
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

    <!-- 🔵 JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const rowsPerPage = 8;
            let currentPage = 1;
            const table = document.getElementById("notificationsTable");
            const tbody = table.querySelector("tbody");
            const pagination = document.getElementById("pagination");
            const allRows = Array.from(tbody.querySelectorAll("tr"));

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
                attachDeleteListeners();
            }

            function renderPagination() {
                pagination.innerHTML = "";
                const totalPages = Math.ceil(allRows.length / rowsPerPage);

                ['First', 'Previous', ...Array.from({ length: totalPages }, (_, i) => i + 1), 'Next', 'Last']
                    .forEach(label => {
                        const button = document.createElement("button");
                        button.textContent = label;
                        button.className = "btn btn-sm btn-outline-primary mx-1";
                        button.disabled = (
                            (label === 'First' && currentPage === 1) ||
                            (label === 'Previous' && currentPage === 1) ||
                            (label === 'Last' && currentPage === totalPages) ||
                            (label === 'Next' && currentPage === totalPages)
                        );

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
                            window.location.href = `/customer/session/notification-details/${notificationId}`;
                        } else {
                            console.error('Notification ID not found!');
                        }
                    });
                });
            }

            // function attachDeleteListeners() {
            //     document.querySelectorAll('.delete-notification').forEach(button => {
            //         button.addEventListener('click', function () {
            //             const row = this.closest('tr');
            //             const notificationId = row.getAttribute('data-id');
            //             const notificationText = row.querySelector('.notification-text').textContent;

            //             if (!notificationId) {
            //                 console.error('No notification ID found on row.');
            //                 return;
            //             }

            //             if (confirm(`Are you sure you want to delete this notification?\n"${notificationText}"`)) {
            //                 console.log(`Sending DELETE for ID: ${notificationId}`);

            //                 fetch(`/customer/session/notifications/${notificationId}`, {
            //                     method: 'DELETE',
            //                     headers: {
            //                         'Content-Type': 'application/json',
            //                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            //                     }
            //                 })
            //                 .then(response => {
            //                     console.log('Raw response:', response);
            //                     return response.json().then(data => ({
            //                         status: response.status,
            //                         body: data
            //                     }));
            //                 })
            //                 .then(({ status, body }) => {
            //                     console.log('Parsed response:', body);

            //                     if (status === 200 && body.success) {
            //                         console.log('Notification deleted successfully.');
            //                         row.remove();
            //                         window.location.reload(); 
            //                     } else {
            //                         console.warn('Failed to delete:', body.error || 'Unknown error');
            //                         alert(body.error || 'Failed to delete notification.');
            //                     }
            //                 })
            //                 .catch(error => {
            //                     console.error('Fetch error:', error);
            //                     alert('An error occurred while deleting the notification.');
            //                 });
            //             }
            //         });
            //     });
            // }

            function attachDeleteListeners() {
                $('.delete-notification').on('click', function () {
                    const row = $(this).closest('tr');
                    const notificationId = row.data('id');
                    const notificationText = row.find('.notification-text').text();

                    if (!notificationId) {
                        console.error('No notification ID found on row.');
                        return;
                    }

                    if (confirm(`Are you sure you want to delete this notification?\n"${notificationText}"`)) {
                        console.log(`Sending DELETE for ID: ${notificationId}`);

                        $.ajax({
                            url: '{{ route("customer.notifications.destroy", ":id") }}'.replace(':id', notificationId),
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                console.log('Parsed response:', response);

                                if (response.success) {
                                    console.log('Notification deleted successfully.');
                                    row.remove();
                                    location.reload(); // Optional: reload to reflect changes
                                } else {
                                    console.warn('Failed to delete:', response.error || 'Unknown error');
                                    alert(response.error || 'Failed to delete notification.');
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('AJAX error:', error);
                                alert('An error occurred while deleting the notification.');
                            }
                        });
                    }
                });
            }


            renderTable();
        });
    </script>
@endsection