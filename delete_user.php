<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "fitzone_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = intval($_GET['id']); 

    if ($type === 'customer') {
        $sql = "DELETE FROM customers WHERE id = ?";
    } elseif ($type === 'staff') {
        $sql = "DELETE FROM staff WHERE id = ?";
    } else {
        die("Invalid user type.");
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully!'); window.location.href='AdminDashboard.html';</script>";
    } else {
        echo "<script>alert('Error deleting user.'); window.location.href='AdminDashboard.html';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Missing parameters.'); window.location.href='AdminDashboard.html';</script>";
}

$conn->close();
?>
