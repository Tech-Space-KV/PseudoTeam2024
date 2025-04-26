<div class="rightbar" id="rightbar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <div class="mx-auto w-75" id="">
                <!-- <a href="{{ url('customer/session/notifications') }}" type="button" class="btn btn-primary position-relative me-2" style="float: left;">
                    <i class="fa fa-bell text-white"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        99+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a> -->

                <a href="{{ url('customer/session/notifications') }}" type="button"
                    class="btn btn-primary position-relative me-2" style="float: left;">
                    <i class="fa fa-bell text-white"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        id="unread-notification-count">
                        {{ session('unreadNotificationsCount', 0) > 99 ? '99+' : session('unreadNotificationsCount', 0) }}
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>

                <!-- <a href="{{ url('logout') }}" type="button" class="btn btn-outline-danger position-relative ms-2" style="float: right;">
                    Logout <i class="fa fa-sign-out"></i>
                </a> -->

                <form action="{{ route('customer.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger position-relative ms-2" style="float: right;">
                        Logout <i class="fa fa-sign-out"></i>
                    </button>
                </form>

            </div>
        </div>
    </nav>
    <hr>
    <div class="container text-light">

        <div class="row justify-content-md-center mt-2">
            <div class="col col-lg-10 d-flex flex-column align-items-center mx-2">
                <p class="text-dark"><span class="fw-bold fs-3">Your Cart <i class="fa fa-shopping-cart"></i></span></p>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-10 sitem d-flex flex-column align-items-center mx-2">
                <a href="{{ url('customer/session/cart') }}" class="text-decoration-none w-100">
                    <div class="card p-3 w-100 cardbgylw">
                        <i class="fa fa-bullseye"></i><span class="cart-count">{{ session('cartCount') }}</span> Items in your cart
                    </div>
                </a>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-10 sitem d-flex flex-column align-items-center mx-2">
                <a href="{{ url('customer/session/marketplace/hardwares-orders') }}" class="text-decoration-none w-100">
                    <div class="card p-3 w-100 cardbgylw">
                        <i class="fa fa-bullseye"></i> Order History
                    </div>
                </a>
            </div>
        </div>

        {{--
        <hr class="border border-1 border-primary"> --}}

        <div class="row justify-content-md-center">
            <div class="col col-lg-10 sitem d-flex flex-column align-items-center mx-2">
                <a href="" class="text-decoration-none w-100">
                    <div class="card p-3 w-100 cardbgylw">
                        Visit Partner Zone
                    </div>
                </a>
            </div>
        </div>

        <div id="calendar"
            style="width: 100%; max-width: 400px; margin: 20px auto; border: 1px solid #ccc; border-radius: 8px; padding: 15px; text-align: center; background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div id="calendar-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <button onclick="prevMonth()"
                    style="background-color:  #006EC4; padding: 8px 12px; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">&#9664;</button>
                <h3 id="month-year" style="margin: 0; font-size: 1.2em; color: #333; font-weight: bold;"></h3>
                <button onclick="nextMonth()"
                    style="padding: 8px 12px; background-color:  #006EC4; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">&#9654;</button>
            </div>
            <div id="calendar-grid"
                style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 3px; color:black;text-align: center; background-color: #f9f9f9; border-radius: 5px;">
                <!-- Dates will be dynamically inserted here -->
            </div>
        </div>
    </div>
</div>


<div id="dateModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1050; justify-content: center; align-items: center;">

    <div style="background: white; width: 50%; max-width: 800px; padding: 30px; border-radius: 12px; text-align: center; position: relative; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);">

        <button onclick="closeModal()"
            style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 22px; font-weight: bold; cursor: pointer; outline: none;">
            &times;
        </button>

        <h4 id="modalTitle" style="margin-bottom: 20px; font-size: 20px; color: #333;"></h4>

        <div id="modalTasksList" style="margin-top: 15px; margin-bottom: 20px; max-height: 250px; overflow-y: auto; padding-right: 5px;"></div>

        <form id="todoForm" style="display: flex; flex-direction: column; gap: 10px;">

            <input type="text" name="date" id="date" required placeholder="Date (YYYY-MM-DD)"
                style="padding: 10px; border: 1px solid #ccc; border-radius: 8px; font-size: 16px; outline: none; width: 100%;">

            <input type="text" name="task" id="task" required placeholder="Enter Task"
                style="padding: 10px; border: 1px solid #ccc; border-radius: 8px; font-size: 16px; outline: none; width: 100%;">

            <button type="submit" style="padding: 10px 20px; background-color: #006EC4; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; outline: none; align-self: center;">
                Add Task
            </button>

        </form>

    </div>
</div>

<!-- Animations -->


<!-- 🛠️ Global URLs -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addTodoUrl = "{{ route('todo.add') }}";
        const deleteTodoUrl = "{{ route('todo.delete') }}";
        const fetchTodosUrl = "{{ route('todo.fetch') }}";
        const csrfToken = '{{ csrf_token() }}'; // Make sure it's available

        let tasks = {};
        let currentDateKey = '';

        // Fetch all existing tasks on page load
        fetch(fetchTodosUrl, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }

            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    data.data.forEach(todo => {
                        const dateKey = todo.td_date;
                        if (!tasks[dateKey]) tasks[dateKey] = [];
                        tasks[dateKey].push(todo.td_event);
                    });
                }
                renderCalendar();
            })
            .catch(error => {
                console.error('Error fetching tasks:', error);
                renderCalendar(); // Still render
            });

        const today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();

        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December'
        ];

        function renderCalendar() {
            const calendarGrid = document.getElementById('calendar-grid');
            const monthYear = document.getElementById('month-year');

            calendarGrid.innerHTML = '';
            const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            daysOfWeek.forEach(day => {
                const dayCell = document.createElement('div');
                dayCell.textContent = day;
                dayCell.style.fontWeight = 'bold';
                dayCell.style.color = '#006EC4'; // Corporate Blue
                dayCell.style.backgroundColor = '#f1f5f9'; // Soft background for headings
                dayCell.style.padding = '8px 0';
                dayCell.style.borderRadius = '4px';
                calendarGrid.appendChild(dayCell);
            });

            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                calendarGrid.appendChild(emptyCell);
            }


            for (let date = 1; date <= daysInMonth; date++) {
                const fullDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                const dateCell = document.createElement('div');
                dateCell.textContent = date;
                // dateCell.style.padding = '6px';
                dateCell.style.height = '40px';
                dateCell.style.display = 'flex';
                dateCell.style.alignItems = 'center';
                dateCell.style.justifyContent = 'center';
                dateCell.style.cursor = 'pointer';
                dateCell.style.borderRadius = '8px'; // more rounded
                dateCell.style.transition = 'background-color 0.3s, color 0.3s'; // smooth hover transition
                dateCell.style.backgroundColor = tasks[fullDate] ? '#006EC4' : '#f9fafb';
                dateCell.style.color = tasks[fullDate] ? '#ffffff' : '#374151'; // white if task, dark grey otherwise
                dateCell.style.fontWeight = '500'; // semi-bold for clean look

                // Hover effect
                dateCell.addEventListener('mouseenter', () => {
                    if (tasks[fullDate]) {
                        dateCell.style.backgroundColor = '#0056a3'; // darker blue on hover if tasks
                    } else {
                        dateCell.style.backgroundColor = '#e5e7eb'; // subtle grey on hover
                    }
                });

                dateCell.addEventListener('mouseleave', () => {
                    dateCell.style.backgroundColor = tasks[fullDate] ? '#006EC4' : '#f9fafb'; // original
                });

                dateCell.addEventListener('click', () => {
                    openModal(fullDate);
                });

                calendarGrid.appendChild(dateCell);
            }

            monthYear.textContent = `${monthNames[currentMonth]} ${currentYear}`;
        }

        function openModal(date) {
            currentDateKey = date;
            document.getElementById('date').value = date;
            const modal = document.getElementById('dateModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalTasksList = document.getElementById('modalTasksList');

            modalTitle.textContent = `Tasks for ${date}`;
            modalTasksList.innerHTML = '';

            if (tasks[date]) {
                tasks[date].forEach(task => {
                    const taskItem = document.createElement('div');
                    taskItem.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; background-color: #f1f5f9; padding: 8px 12px; margin-bottom: 8px; border-radius: 8px;">
        <span style="color: #333; font-size: 16px;">${task}</span>
        <button onclick="deleteTask('${date}', '${task.replace(/'/g, "\\'")}')" style="background-color: #e3342f; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 14px; font-weight: bold; cursor: pointer;">Delete</button>
    </div>
`;

                    modalTasksList.appendChild(taskItem);
                });
            }

            modal.style.display = 'flex';
        }

        window.deleteTask = function(date, task) {
            if (!confirm('Delete this task?')) return;

            fetch(deleteTodoUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        date: date,
                        task: task
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // ✅ Successfully deleted. Now update the tasks object manually before fetching again.
                        if (tasks[date]) {
                            // Remove the task from the local tasks array
                            tasks[date] = tasks[date].filter(t => t !== task);

                            // If no tasks left for this date, remove the date key
                            if (tasks[date].length === 0) {
                                delete tasks[date];
                            }
                        }

                        // 🛠 Re-render calendar immediately
                        renderCalendar();

                        // 🛠 Close modal (because it might be empty now)
                        closeModal();

                        // (optional) Fetch fresh tasks to sync with server
                        fetch(fetchTodosUrl, {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                }
                            })
                            .then(response => response.json())
                            .then(freshData => {
                                if (freshData.success) {
                                    tasks = {};
                                    freshData.data.forEach(todo => {
                                        const dateKey = todo.td_date;
                                        if (!tasks[dateKey]) tasks[dateKey] = [];
                                        tasks[dateKey].push(todo.td_event);
                                    });
                                    renderCalendar();
                                }
                            })
                            .catch(error => console.error('Error fetching updated tasks:', error));
                    } else {
                        alert('Failed to delete task');
                    }
                })
                .catch(error => console.error('Error deleting task:', error));
        };

        window.closeModal = function() {
            document.getElementById('dateModal').style.display = 'none';
        };

        window.prevMonth = function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        };

        window.nextMonth = function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        };

        document.getElementById('todoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const date = document.getElementById('date').value;
            const task = document.getElementById('task').value;

            fetch(addTodoUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },

                    body: JSON.stringify({
                        date: date,
                        task: task
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (!tasks[date]) tasks[date] = [];
                        tasks[date].push(task);
                        document.getElementById('todoForm').reset();
                        closeModal();
                        renderCalendar();
                    } else {
                        alert('Failed to add task');
                        console.log(data);
                    }
                })
                .catch(error => console.error('Error adding task:', error));
        });
    });
</script>