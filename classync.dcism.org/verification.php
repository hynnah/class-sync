<?php
if (in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1'])) {
    // LOCALHOST
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "classync";
} else {
    // ONLINE
    $$servername = "localhost";
    $username = "s22101929_classync";
    $password = "pass9562761191";
    $dbname = "s22101929_classync";
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed! " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"])) {
        $Name = $_POST["name"];
        $Email = $_POST["email"];
        $Password = $_POST["password"];
        $hashed_password = password_hash($Password, PASSWORD_DEFAULT);
        $role = $_POST["account-type"];

        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $Name, $Email, $hashed_password, $role);

        if ($stmt->execute()) {
            header("refresh:3;url=index.html"); //Redirect to Login.html for 3 SECONDSS!!
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
    // For login form!!!!!!!!!!!!
    else if (isset($_POST["email"]) && isset($_POST["password"])) { // so basically, if naay email og password naka set... 
        $Email = $_POST["email"];
        $Password = $_POST["password"];
        
        $stmt = $conn->prepare("SELECT email, name, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $Email); //...ee find niya ang details based on the Email given
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($Password, $user["password"])) { // here, if ni match ang giinput na password sa set na password...
                session_start(); //...mo start ang session yey :D
                $_SESSION["user_email"] = $user["email"];
                $_SESSION["user_name"] = $user["name"];
                $_SESSION["user_role"] = $user["role"];

                if ($user["role"] == "admin") {
                    header("Location: ./admin/admin_dashboard.php");
                } else {
                    header("Location: student_dashboard.php");
                }
                exit();
            } else {
                echo "Invalid password!";
                header("refresh:3;url=index.html"); //Redirect napud sa Login for 3 seconds
            }
        } else {
            echo "User not found!";
            header("refresh:3;url=index.html"); //Redirect nasad sa Login for 3 seconds
        }
        
        $stmt->close();
    }
}

$conn->close();
?>