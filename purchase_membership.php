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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    list($membership_type, $price) = explode("|", $_POST["membership"]);

    $stmt = $conn->prepare("INSERT INTO customer_memberships (username, membership_type, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $username, $membership_type, $price);

    if ($stmt->execute()) {
        echo "<script>alert('Membership purchased successfully!'); window.location.href='CustomerDashboard.html';</script>";
    } else {
        echo "<script>alert('Purchase failed!'); window.location.href='CustomerDashboard.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
