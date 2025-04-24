<div class="rightbar" id="rightbar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <div class="mx-auto w-75" id="">
                <a href="{{ url('service-partner/session/notifications') }}" type="button" class="btn btn-primary position-relative me-2" style="float: left;">
                    <i class="fa fa-bell text-white"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        99+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>

                <a type="button" class="btn btn-outline-danger position-relative ms-2" style="float: right;">
                    Logout <i class="fa fa-sign-out"></i>
                </a>

            </div>
        </div>
    </nav>
    <hr>
    <div class="container text-light">

        <div class="row justify-content-md-center mt-2">
            <div class="col col-lg-10 d-flex flex-column align-items-center mx-2">
                <p class="text-dark"><span class="fw-bold fs-4">Your Profile <i class="fa fa-pie-chart"></i></span></p>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-10 sitem d-flex flex-column align-items-center mx-2">
                <a href="" class="text-decoration-none w-100">
                    <div class="card p-3 w-100 cardbgylw">
                       Visit Customer Zone
                       
                    </div>
                </a>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-10 sitem d-flex flex-column align-items-center mx-2">
                <a href="" class="text-decoration-none w-100">
                    <div class="card p-3 w-100 cardbgylw">
                       Job Success Rate
                       <div class="progress mt-2">
                        <div class="progress-bar" role="progressbar" style="width: {{ session('jobSuccessRate') }}%;" aria-valuenow="{{ session('jobSuccessRate') }}" aria-valuemin="0" aria-valuemax="100">{{ session('jobSuccessRate') }}%</div>
                      </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="row justify-content-md-center">
            <div class="col col-lg-10 sitem d-flex flex-column align-items-center mx-2">
                <a href="" class="text-decoration-none w-100">
                    <div class="card p-3 w-100 cardbgylw">
                       Job Ratings
                       <span class="mt-2">
                       <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 
                       <i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                       </span>
                    </div>
                </a>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-10 sitem d-flex flex-column align-items-center mx-2">
                <a href="{{ url('service-partner/session/hardware-orders') }}" class="text-decoration-none w-100">
                    <div class="card p-3 w-100 cardbgylw">
                        <i class="fa fa-bullseye"></i> Order History
                    </div>
                </a>
            </div>
        </div>

        <div id="calendar" style="width: 100%; max-width: 400px; margin: 20px auto; border: 1px solid #ccc; border-radius: 8px; padding: 15px; text-align: center; background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div id="calendar-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <button onclick="prevMonth()" style="background-color:  #006EC4; padding: 8px 12px; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">&#9664;</button>
                <h3 id="month-year" style="margin: 0; font-size: 1.2em; color: #333; font-weight: bold;"></h3>
                <button onclick="nextMonth()" style="padding: 8px 12px; background-color:  #006EC4; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">&#9654;</button>
            </div>
            <div id="calendar-grid" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 3px; color:black;text-align: center; background-color: #f9f9f9; border-radius: 5px;">
                <!-- Dates will be dynamically inserted here -->
            </div>
        </div>
    </div>
</div>

<!-- Modal for Notifications -->
<div id="dateModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: white; width: 300px; padding: 20px; border-radius: 8px; text-align: center; position: relative; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <button onclick="closeModal()" style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 18px; font-weight: bold; cursor: pointer;">&times;</button>
        <h4 id="modalTitle"></h4>
        <p id="modalBody"></p>
    </div>
</div>

<script>
    const calendarGrid = document.getElementById('calendar-grid');
    const monthYear = document.getElementById('month-year');
    const today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    // Map to store multiple notifications for specific dates
    const notifications = {
        '2025-01-15': ['Team meeting at 10:00 AM', 'Submit timesheet'],
        '2025-01-20': ['Project submission deadline', 'Client call at 2:00 PM'],
        '2025-01-25': ['Office holiday'],
    };

    function renderCalendar(month, year) {
        calendarGrid.innerHTML = '';
        monthYear.textContent = new Date(year, month).toLocaleString('default', {
            month: 'long',
            year: 'numeric'
        });

        // Render weekday headers
        const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        weekdays.forEach(day => {
            const cell = document.createElement('div');
            cell.textContent = day;
            cell.style.fontWeight = 'bold';
            cell.style.fontSize = '0.9em';
            cell.style.color = '#006EC4';
            calendarGrid.appendChild(cell);
        });

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Add blank cells for days before the start of the month
        for (let i = 0; i < firstDay; i++) {
            const cell = document.createElement('div');
            calendarGrid.appendChild(cell);
        }

        // Render day cells
        for (let day = 1; day <= daysInMonth; day++) {
            const cell = document.createElement('div');
            const dateKey = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            cell.textContent = day;
            cell.style.padding = '12px 0';
            cell.style.border = '1px solid #ddd';
            cell.style.borderRadius = '4px';
            cell.style.cursor = 'pointer';
            cell.style.fontSize = '0.9em';
            cell.style.transition = '0.2s';

            // Highlight dates with notifications
            if (notifications[dateKey]) {
                cell.style.backgroundColor = '#006EC4'; // Highlight color
                cell.style.color = 'white';
                cell.style.fontWeight = 'bold';
            }

            // Add hover effect
            cell.onmouseover = () => (cell.style.backgroundColor = '#006EC4', cell.style.color = 'white');
            cell.onmouseout = () => {
                if (notifications[dateKey]) {
                    cell.style.backgroundColor = '#006EC4';
                    cell.style.color = 'white';
                } else {
                    cell.style.backgroundColor = '';
                    cell.style.color = '';
                }
            };

            // Show modal with notifications when clicked
            cell.onclick = () => {
                if (notifications[dateKey]) {
                    showModal(dateKey, notifications[dateKey]);
                } else {
                    showModal(dateKey, ['No notifications for this date.']);
                }
            };

            calendarGrid.appendChild(cell);
        }
    }

    function showModal(date, messages) {
        const modal = document.getElementById('dateModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalBody = document.getElementById('modalBody');

        modalTitle.textContent = `Notifications for ${date}`;
        modalTitle.style.fontSize = '1.25em'; // Adjust font size here
        modalBody.innerHTML = messages.map(msg => `<br><p>${msg}</p>`).join('');
        modal.style.display = 'flex';
    }

    function closeModal() {
        const modal = document.getElementById('dateModal');
        modal.style.display = 'none';
    }

    function prevMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    }

    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    }

    renderCalendar(currentMonth, currentYear);
</script>