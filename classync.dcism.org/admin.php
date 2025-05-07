<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Classync</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
        <style>
        /* Background overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Popup content */
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 350px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        /* Buttons */
        .role-btn {
            display: block;
            margin: 10px auto;
            padding: 10px 15px;
            width: 80%;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .student-btn { background-color: #4CAF50; color: white; }
        .creator-btn { background-color: #008CBA; color: white; }
        .continue-btn {
            margin-top: 15px;
            padding: 10px;
            background: #f44336;
            color: white;
            border: none;
            cursor: pointer;
            display: none;
            border-radius: 5px;
            width: 100%;
        }

        /* Hide registration form initially */
        .registration-form {
            display: none;
            width: 350px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: white;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        input, select, button {
            width: 100%;
            margin: 10px 0;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="LogoContainer">
            <a href="Login.html"><img src="Resources/Logo.png" alt="Classync Logo"></a>
            <h2>Classync</h2>
        </div>
        <p>A CLASSIC WAY TO STAY IN SYNC</p>
    </header>

    <!-- Role Selection Popup -->
    <div class="modal-overlay" id="popup">
        <div class="modal-content">
            <h2>Are you a...</h2>
            <button class="role-btn student-btn" onclick="selectRole('student')">Student</button>
            <button class="role-btn creator-btn" onclick="selectRole('space_creator')">Space Creator</button>
            <button class="continue-btn" id="continue-btn" onclick="proceedToSignup()">Continue</button>
            <input type="hidden" id="selected-role">
        </div>
    </div>

    <!-- Registration Form -->
    <div class="registration-form" id="registration-form">
        <h2 id="form-title">Sign Up</h2>
        <p id="role-text">Register as: </p>
        <input type="text" placeholder="Full Name" required>
        <input type="email" placeholder="Email Address" required>
        <input type="password" placeholder="Password" required>
        <input type="password" placeholder="Confirm Password" required>
        <button type="submit">Sign Up</button>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById("selected-role").value = role;
            document.getElementById("continue-btn").style.display = "block";
        }

        function proceedToSignup() {
            let role = document.getElementById("selected-role").value;
            if (!role) return;

            // Hide the popup
            document.getElementById("popup").style.display = "none";
            
            // Show the registration form
            document.getElementById("registration-form").style.display = "block";

            // Change form text based on role
            let formTitle = document.getElementById("form-title");
            let roleText = document.getElementById("role-text");

            
                formTitle.innerText = "Sign Up";
                roleText.innerText = "Register to continue";
        }
    </script>
    <p style="padding-top: 60px;">welcome admin</p>
</body>

</html>