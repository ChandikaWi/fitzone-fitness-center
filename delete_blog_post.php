<?php
include 'db_connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete blog post from database
    $sql = "DELETE FROM blog_posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>
