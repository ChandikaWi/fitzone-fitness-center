<?php
session_start();

//Check if admin is logged in
if (!isset($_SESSION['admin_username'])) {
    echo "<script>alert('Access Denied!'); window.location.href='LoginForm.html';</script>";
    exit();
}

$host = "localhost";
$user = "root";  
$pass = "";      
$dbname = "fitzone_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Handle Staff Account Creation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff_username = trim($_POST["staff_username"]);
    $staff_password = trim($_POST["staff_password"]);
    $hashed_password = password_hash($staff_password, PASSWORD_DEFAULT); 

    //Check if staff username already exists
    $stmt = $conn->prepare("SELECT * FROM staff WHERE username = ?");
    $stmt->bind_param("s", $staff_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Staff username already exists!'); window.location.href='AdminDashboard.html';</script>";
    } else {
        //Insert new staff account into database
        $stmt = $conn->prepare("INSERT INTO staff (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $staff_username, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Staff account created successfully!'); window.location.href='AdminDashboard.html';</script>";
        } else {
            echo "<script>alert('Error creating staff account!'); window.location.href='AdminDashboard.html';</script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
