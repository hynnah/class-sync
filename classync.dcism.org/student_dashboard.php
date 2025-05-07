<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <title>Classync - Student Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include_once './Resources/header.html'; ?>
    <div style="margin-top: 100px; text-align: center; font-family: 'Poppins', sans-serif;">
        <?php
        session_start();
        if (isset($_SESSION["user_name"])) {
            echo "<h1>Welcome, " . $_SESSION["user_name"] . "!</h1>";
        } else {
            echo "<h1>Welcome to Classync</h1>";
        }
        ?>
        <p>This is your Student Dashboard. Here you'll see your calendar and tasks.</p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>