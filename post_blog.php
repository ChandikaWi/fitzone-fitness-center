<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "fitzone_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    $title = $_POST['title'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert into database
    $sql = "INSERT INTO blog_posts (title, image) VALUES ('$title', '$target_file')";
    if ($conn->query($sql) === TRUE) {
        echo "Blog posted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
