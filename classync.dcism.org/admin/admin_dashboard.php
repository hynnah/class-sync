<?php
    session_start();
    
    // Check if user is logged in and is an admin
    if (!isset($_SESSION["user_role"]) || $_SESSION["user_role"] != "admin") {
        header("Location: index.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../style.css">
    <title>Classync - Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
</head>
<body>
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-container">
            <div class="welcome-header">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION["user_name"]); ?>!</h1>
            </div>
            
            <!-- Calendar Section -->
            <div class="calendar-container">
                <div class="calendar-header">
                    <div class="month-navigation">
                        <button onclick="changeMonth(-1)">&#8592;</button>
                        <h3 class="month-year" id="currentMonthYear"></h3>
                        <button onclick="changeMonth(1)">&#8594;</button>
                    </div>
                    <div class="search-date">
                        <select id="monthSelect">
                            <option value="0">January</option>
                            <option value="1">February</option>
                            <option value="2">March</option>
                            <option value="3">April</option>
                            <option value="4">May</option>
                            <option value="5">June</option>
                            <option value="6">July</option>
                            <option value="7">August</option>
                            <option value="8">September</option>
                            <option value="9">October</option>
                            <option value="10">November</option>
                            <option value="11">December</option>
                        </select>
                        <select id="yearSelect">
                            <?php
                            // Generate year options from 2025 to 2030
                            for ($year = 2025; $year <= 2030; $year++) {
                                echo "<option value=\"$year\">$year</option>";
                            }
                            ?>
                        </select>
                        <button onclick="searchDate()">Go</button>
                    </div>
                </div>
                
                <div class="calendar" id="calendar">
                    <!-- Days of the week headers -->
                    <div class="day-header">Sun</div>
                    <div class="day-header">Mon</div>
                    <div class="day-header">Tue</div>
                    <div class="day-header">Wed</div>
                    <div class="day-header">Thu</div>
                    <div class="day-header">Fri</div>
                    <div class="day-header">Sat</div>
                    
                    <!-- Calendar days will be generated by JavaScript -->
                </div>
            </div>
            
            <!-- Reminders/Tasks Section -->
            <div class="reminders-container">
                <div class="reminders-header">
                    <h3>Reminders</h3>
                    <button class="add-event-btn" onclick="openAddEventModal()">+ Add Event</button>
                </div>
                
                <div class="reminder-section">
                    <h4 onclick="toggleSection('today-tasks')">Today</h4>
                    <ul class="reminder-list" id="today-tasks">
                        <!-- These will be populated dynamically -->
                        <li class="reminder-item">
                            <input type="checkbox">
                            <div class="reminder-text">Finalize exam schedule</div>
                            <div class="reminder-date">Due today</div>
                        </li>
                    </ul>
                </div>
                
                <div class="reminder-section" style ="padding-bottom: 10%;">
                    <h4 onclick="toggleSection('upcoming-tasks')">This Week</h4>
                    <ul class="reminder-list" id="upcoming-tasks">
                        <!-- These will be populated dynamically -->
                        <li class="reminder-item">
                            <input type="checkbox">
                            <div class="reminder-text">Review student assignments</div>
                            <div class="reminder-date">Due in 2 days</div>
                        </li>
                        <li class="reminder-item">
                            <input type="checkbox">
                            <div class="reminder-text">Update class materials</div>
                            <div class="reminder-date">Due in 4 days</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal for Adding Events -->
    <div class="modal" id="addEventModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Event</h3>
                <button class="close-modal" onclick="closeAddEventModal()">&times;</button>
            </div>
            <form class="modal-form" id="eventForm">
                <label for="eventTitle">Title</label>
                <input type="text" id="eventTitle" required>
                
                <label for="eventDate">Date</label>
                <input type="date" id="eventDate" required>
                
                <label for="eventTime">Time</label>
                <input type="time" id="eventTime">
                
                <label for="eventCategory">Category</label>
                <select id="eventCategory">
                    <option value="assignment">Assignment</option>
                    <option value="quiz">Quiz</option>
                    <option value="exam">Examination</option>
                    <option value="project">Project</option>
                    <option value="presentation">Presentation</option>
                    <option value="other">Other</option>
                </select>
                
                <label for="eventDescription">Description</label>
                <textarea id="eventDescription" rows="3"></textarea>
                
                <label for="assignTo">Assign To (Optional)</label>
                <select id="assignTo">
                    <option value="">Everyone</option>
                    <option value="student1">Student 1</option>
                    <option value="student2">Student 2</option>
                    <!-- These would be populated from the database -->
                </select>
                
                <button type="button" onclick="saveEvent()">Save Event</button>
            </form>
        </div>
    </div>
    <?php include_once"generalLayout.html";?>
    <script>
        // Global variables
        let currentDate = new Date();
        let events = []; // This would be loaded from the database
        
        // Initialize the calendar when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Set default values for date selectors to current month/year
            document.getElementById('monthSelect').value = currentDate.getMonth();
            document.getElementById('yearSelect').value = currentDate.getFullYear();
            
            updateCalendar();
            loadEvents(); // This would fetch events from the database
        });
        
        // Update the calendar with the current month
        function updateCalendar() {
            const calendar = document.getElementById('calendar');
            const monthYearDisplay = document.getElementById('currentMonthYear');
            
            // Clear previous days (except headers)
            const headers = Array.from(calendar.querySelectorAll('.day-header'));
            calendar.innerHTML = '';
            headers.forEach(header => calendar.appendChild(header));
            
            // Display current month and year
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 
                               'July', 'August', 'September', 'October', 'November', 'December'];
            monthYearDisplay.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
            
            // Get first day of the month and number of days
            const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
            const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
            
            // Add empty cells for days before the first day of the month
            for (let i = 0; i < firstDay.getDay(); i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'calendar-day empty';
                calendar.appendChild(emptyDay);
            }
            
            // Add days of the month
            const today = new Date();
            for (let i = 1; i <= lastDay.getDate(); i++) {
                const day = document.createElement('div');
                day.className = 'calendar-day';
                
                // Check if this day is today
                if (today.getDate() === i && 
                    today.getMonth() === currentDate.getMonth() && 
                    today.getFullYear() === currentDate.getFullYear()) {
                    day.style.border = '2px solid #4CAF50';
                }
                
                // Check if this day has events
                const hasEvents = checkForEvents(i);
                if (hasEvents) {
                    day.classList.add('has-events');
                    const indicator = document.createElement('div');
                    indicator.className = 'event-indicator';
                    day.appendChild(indicator);
                    
                    // Add preview of the first event
                    const eventPreview = document.createElement('div');
                    eventPreview.className = 'event-preview';
                    eventPreview.textContent = getEventPreview(i);
                    day.appendChild(eventPreview);
                }
                
                const dayNumber = document.createElement('div');
                dayNumber.className = 'day-number';
                dayNumber.textContent = i;
                day.appendChild(dayNumber);
                
                // Make days clickable to add events
                day.addEventListener('click', function() {
                    const selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);
                    openAddEventModal(selectedDate);
                });
                
                calendar.appendChild(day);
            }
        }
        
        // Change month when arrow buttons are clicked
        function changeMonth(delta) {
            currentDate.setMonth(currentDate.getMonth() + delta);
            updateCalendar();
        }
        
        // Search for a specific month and year
        function searchDate() {
            const monthSelect = document.getElementById('monthSelect');
            const yearSelect = document.getElementById('yearSelect');
            
            currentDate = new Date(yearSelect.value, monthSelect.value, 1);
            updateCalendar();
        }
        
        // Check if a day has events
        function checkForEvents(day) {
            // In a real application, this would check against stored events
            // For now, we'll simulate some events
            return events.some(event => {
                const eventDate = new Date(event.date);
                return eventDate.getDate() === day && 
                       eventDate.getMonth() === currentDate.getMonth() && 
                       eventDate.getFullYear() === currentDate.getFullYear();
            });
        }
        
        // Get preview text for the first event on a day
        function getEventPreview(day) {
            // Find the first event for this day
            const dayEvents = events.filter(event => {
                const eventDate = new Date(event.date);
                return eventDate.getDate() === day && 
                       eventDate.getMonth() === currentDate.getMonth() && 
                       eventDate.getFullYear() === currentDate.getFullYear();
            });
            
            if (dayEvents.length > 0) {
                return dayEvents[0].title;
            }
            return '';
        }
        
        
        // Toggle reminder sections (today, this week)
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            section.style.display = section.style.display === 'none' ? 'block' : 'none';
        }
        
        // Open modal for adding events
        function openAddEventModal(date) {
            const modal = document.getElementById('addEventModal');
            modal.style.display = 'flex';
            
            // If a date was provided, set the date input
            if (date) {
                const formattedDate = date.toISOString().split('T')[0];
                document.getElementById('eventDate').value = formattedDate;
            }
        }
        
        // Close add event modal
        function closeAddEventModal() {
            const modal = document.getElementById('addEventModal');
            modal.style.display = 'none';
            
            // Clear form
            document.getElementById('eventForm').reset();
        }
        
        // Save event (would normally save to database)
        function saveEvent() {
            const title = document.getElementById('eventTitle').value;
            const date = document.getElementById('eventDate').value;
            const time = document.getElementById('eventTime').value;
            const category = document.getElementById('eventCategory').value;
            const description = document.getElementById('eventDescription').value;
            const assignTo = document.getElementById('assignTo').value;
            
            if (!title || !date) {
                alert('Please enter a title and date for the event.');
                return;
            }
            
            // Create event object
            const newEvent = {
                id: Date.now(), // Simple temporary ID
                title: title,
                date: date,
                time: time,
                category: category,
                description: description,
                assignTo: assignTo
            };
            
            // In a real app, we would save this to the database
            // For now, just add to our local array
            events.push(newEvent);
            
            // Update the calendar to show the new event
            updateCalendar();
            
            // Close the modal
            closeAddEventModal();
            
            // For demonstration purposes, also add to the reminders list
            addToRemindersList(newEvent);
        }
        
        // Add event to the reminders list
        function addToRemindersList(event) {
            const eventDate = new Date(event.date);
            const today = new Date();
            const dayDiff = Math.floor((eventDate - today) / (1000 * 60 * 60 * 24));
            
            let listElement;
            let dueText;
            
            if (dayDiff === 0) {
                listElement = document.getElementById('today-tasks');
                dueText = 'Due today';
            } else if (dayDiff < 7) {
                listElement = document.getElementById('upcoming-tasks');
                dueText = `Due in ${dayDiff} day${dayDiff !== 1 ? 's' : ''}`;
            } else {
                // Not in this week
                return;
            }
            
            const listItem = document.createElement('li');
            listItem.className = 'reminder-item';
            listItem.innerHTML = `
                <input type="checkbox">
                <div class="reminder-text">${event.title}</div>
                <div class="reminder-date">${dueText}</div>
            `;
            
            listElement.appendChild(listItem);
        }
        
        // Load events from the server
        function loadEvents() {
            // In a real application, this would be an AJAX call to the server
            // For now, let's simulate some events
            
            // Clear existing events
            events = [];
            
            // Add some sample events
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const nextWeek = new Date(today);
            nextWeek.setDate(nextWeek.getDate() + 5);
            
            events.push({
                id: 1,
                title: 'Finalize exam schedule',
                date: today.toISOString().split('T')[0],
                time: '14:00',
                category: 'other',
                description: 'Finalize and publish the final exam schedule',
                assignTo: ''
            });
            
            events.push({
                id: 2,
                title: 'Review student assignments',
                date: tomorrow.toISOString().split('T')[0],
                time: '10:00',
                category: 'assignment',
                description: 'Review and grade student assignments',
                assignTo: ''
            });
            
            events.push({
                id: 3,
                title: 'Update class materials',
                date: nextWeek.toISOString().split('T')[0],
                time: '09:00',
                category: 'other',
                description: 'Update and upload new class materials',
                assignTo: ''
            });
            
            // Update the calendar with these events
            updateCalendar();
        }
    </script>
</body>
</html>
