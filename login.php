<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "fitzone_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST["user-type"];
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Validate user type
    if (!in_array($userType, ["customer", "admin", "staff"])) {
        echo "<script>alert('Invalid user type!'); window.location.href='LoginForm.html';</script>";
        exit();
    }

    // Determine the table based on user type
    $table = $userType === "customer" ? "customers" : ($userType === "admin" ? "admins" : "staff");
    $stmt = $conn->prepare("SELECT password FROM $table WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Store session data
            $_SESSION["username"] = $username;
            $_SESSION["user_type"] = $userType;
            if ($userType === "admin") {
                $_SESSION["admin_username"] = $username;
            } elseif ($userType === "staff") {
                $_SESSION["staff_username"] = $username;
            }

            // Redirect to appropriate dashboard
            $redirect = $userType === "customer" ? "CustomerDashboard.html" : ($userType === "admin" ? "AdminDashboard.html" : "StaffDashboard.html");
            header("Location: $redirect");
            exit();
        } else {
            echo "<script>alert('Incorrect Password!'); window.location.href='LoginForm.html';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href='LoginForm.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>