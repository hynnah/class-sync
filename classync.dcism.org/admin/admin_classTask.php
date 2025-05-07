<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Class Tasks</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        .task-container {
            margin: 100px 20%;
            background-color: #312e2e;
            border-radius: 10px;
            overflow: hidden;
            color: white;
            
        }
        
        .category-button {
            background-color: white;
            color: black;
            border: none;
            padding: 15px 20px;
            width: 100%;
            text-align: left;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .category-button:hover {
            background-color: #979086;
        }
        
        .category-button:after {
            content: '\002B';
            color: black;
            font-weight: bold;
            float: right;
            margin-left: 5px;
            font-size: 18px;
        }
        
        .category-button.active:after {
            content: "\2212";
        }
        
        .task-list {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background-color: white;
        }
        
        .task-item {
            padding: 15px 20px 15px 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: black;
            display: flex;
            align-items: center;
        }
        
        .task-item:last-child {
            border-bottom: none;
        }
        
        /* Checkbox styling */
        .task-checkbox {
            margin-right: 15px;
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #6d9886;
        }
        
        .task-text {
            flex-grow: 1;
            transition: text-decoration 0.3s ease, opacity 0.3s ease;
        }
        
        .task-checkbox:checked + .task-text {
            text-decoration: line-through;
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <?php include_once"generalLayout.html";?>
    <div class="task-container">
        <div class="category">
            <h2 style="text-align: center; font-weight: 500">Class Reminders</h2>
            <button class="category-button">Assignment</button>
            <div class="task-list">
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task1">
                    <label class="task-text" for="task1">Research Paper on Climate Change</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task2">
                    <label class="task-text" for="task2">Math Problem Set #3</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task3">
                    <label class="task-text" for="task3">Reading Response for Chapter 5</label>
                </div>
            </div>
        </div>
        
        <div class="category">
            <button class="category-button">Activity</button>
            <div class="task-list">
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task4">
                    <label class="task-text" for="task4">Group Discussion on Current Events</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task5">
                    <label class="task-text" for="task5">Lab Exercise: Chemical Reactions</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task6">
                    <label class="task-text" for="task6">Peer Review Session</label>
                </div>
            </div>
        </div>
        
        <div class="category">
            <button class="category-button">Quiz</button>
            <div class="task-list">
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task7">
                    <label class="task-text" for="task7">Weekly Vocabulary Quiz</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task8">
                    <label class="task-text" for="task8">Chapter 4 Assessment</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task9">
                    <label class="task-text" for="task9">Pop Quiz on Recent Lectures</label>
                </div>
            </div>
        </div>
        
        <div class="category">
            <button class="category-button">Project</button>
            <div class="task-list">
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task10">
                    <label class="task-text" for="task10">Website Development Portfolio</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task11">
                    <label class="task-text" for="task11">Group Research Initiative</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task12">
                    <label class="task-text" for="task12">Semester-long Case Study</label>
                </div>
            </div>
        </div>
        
        <div class="category">
            <button class="category-button">Presentation</button>
            <div class="task-list">
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task13">
                    <label class="task-text" for="task13">Individual Topic Presentation</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task14">
                    <label class="task-text" for="task14">Group Findings Report</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task15">
                    <label class="task-text" for="task15">Visual Aid Demonstration</label>
                </div>
            </div>
        </div>
        
        <div class="category">
            <button class="category-button">Exam</button>
            <div class="task-list">
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task16">
                    <label class="task-text" for="task16">Midterm Examination</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task17">
                    <label class="task-text" for="task17">Final Comprehensive Test</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task18">
                    <label class="task-text" for="task18">Practical Skills Assessment</label>
                </div>
            </div>
        </div>
        
        <div class="category">
            <button class="category-button">Others</button>
            <div class="task-list">
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task19">
                    <label class="task-text" for="task19">Extra Credit Opportunity</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task20">
                    <label class="task-text" for="task20">Field Trip Permission Form</label>
                </div>
                <div class="task-item">
                    <input type="checkbox" class="task-checkbox" id="task21">
                    <label class="task-text" for="task21">Office Hours Sign-up</label>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add click event listeners to all category buttons
        const buttons = document.querySelectorAll('.category-button');
        
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Toggle active class on the button
                this.classList.toggle('active');
                
                // Get the next sibling element (the task list)
                const taskList = this.nextElementSibling;
                
                // Toggle the visibility of the task list
                if (taskList.style.maxHeight) {
                    taskList.style.maxHeight = null;
                } else {
                    taskList.style.maxHeight = taskList.scrollHeight + "px";
                }
            });
        });
        
        // Add event listeners to checkboxes to save state
        const checkboxes = document.querySelectorAll('.task-checkbox');
        
        checkboxes.forEach(checkbox => {
            // Load saved state from localStorage if available
            const savedState = localStorage.getItem(checkbox.id);
            if (savedState === 'true') {
                checkbox.checked = true;
            }
            
            // Save state when checkbox is clicked
            checkbox.addEventListener('change', function() {
                localStorage.setItem(this.id, this.checked);
            });
        });
    </script>
</body>
</html>