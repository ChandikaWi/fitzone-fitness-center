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
    if (!isset($_SESSION["username"])) {
        echo "<script>alert('Please log in first!'); window.location.href='LoginForm.html';</script>";
        exit();
    }

    $username = $_SESSION["username"];
    $service = trim($_POST["service"]);
    $trainer = trim($_POST["trainer"]);
    $date = trim($_POST["date"]);
    $time = trim($_POST["time"]);

    $stmt = $conn->prepare("INSERT INTO gym_appointments (username, service, trainer, date, time) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $service, $trainer, $date, $time);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment booked successfully!'); window.location.href='CustomerDashboard.html';</script>";
    } else {
        echo "<script>alert('Error booking appointment!'); window.location.href='CustomerDashboard.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
