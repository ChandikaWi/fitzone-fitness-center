<?php
$host = "localhost";
$user = "root";  
$pass = "";      
$dbname = "fitzone_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hash the password before inserting 
$hashed_password = password_hash("Admin1123", PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (id, username, password) VALUES (1, 'Admin1', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Admin inserted successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
