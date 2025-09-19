<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION["username"])) {
    header("Location: LoginForm.html");
    exit();
}
?>

<style>
   
    .blog-posts-container * {
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .blog-posts-container {
        --primary-color: #dc2626;
        --primary-dark: #b91c1c;
        --primary-light: #ef4444;
        --accent-color: #f59e0b;
        --bg-card: rgba(255, 255, 255, 0.1);
        --text-primary: #111827;
        --text-inverse: #ffffff;
        --border-color: #e5e7eb;
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --gradient-primary: linear-gradient(135deg, #dc2626, #b91c1c);
        --transition-base: 250ms ease;
    }

    .dark-theme .blog-posts-container {
        --bg-card: rgba(31, 41, 55, 0.1);
        --text-primary: #f9fafb;
        --border-color: #374151;
    }

    .blog-posts-container table {
        width: 100%;
        max-width: 1000px;
        margin: 20px auto;
        border-collapse: collapse;
        background: var(--bg-card);
        backdrop-filter: blur(5px);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    .blog-posts-container th,
    .blog-posts-container td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
        font-size: 16px;
        color: var(--text-primary);
    }

    .blog-posts-container th {
        background: var(--gradient-primary);
        color: var(--text-inverse);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .blog-posts-container tr:last-child td {
        border-bottom: none;
    }

    .blog-posts-container tr:nth-child(even) {
        background: rgba(255, 255, 255, 0.05);
    }

    .dark-theme .blog-posts-container tr:nth-child(even) {
        background: rgba(31, 41, 55, 0.05);
    }

    .blog-posts-container tr:hover {
        background: rgba(220, 38, 38, 0.1);
        transition: background var(--transition-base);
    }

    .blog-posts-container td:nth-child(1) {
        text-align: left;
        max-width: 300px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .blog-posts-container td:nth-child(2) img {
        width: 100px;
        height: auto;
        object-fit: cover;
        border-radius: 4px;
        display: block;
        margin: 0 auto;
    }

    .blog-posts-container button {
        background: var(--primary-color);
        color: var(--text-inverse);
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background var(--transition-base);
    }

    .blog-posts-container button:hover {
        background: var(--primary-dark);
    }

    .blog-posts-container button:focus {
        outline: 2px solid var(--primary-light);
        outline-offset: 2px;
    }

    .blog-posts-container p {
        max-width: 1000px;
        margin: 20px auto;
        padding: 15px;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        text-align: center;
        font-size: 18px;
        color: var(--accent-color);
        box-shadow: var(--shadow-md);
    }

    @media (max-width: 768px) {
        .blog-posts-container table {
            display: block;
            overflow-x: auto;
        }

        .blog-posts-container th,
        .blog-posts-container td {
            font-size: 14px;
            padding: 10px;
        }

        .blog-posts-container td:nth-child(1) {
            max-width: 200px;
        }

        .blog-posts-container td:nth-child(2) img {
            width: 80px;
        }

        .blog-posts-container button {
            padding: 6px 12px;
            font-size: 13px;
        }

        .blog-posts-container p {
            font-size: 16px;
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        .blog-posts-container th,
        .blog-posts-container td {
            font-size: 12px;
            padding: 8px;
        }

        .blog-posts-container td:nth-child(1) {
            max-width: 150px;
        }

        .blog-posts-container td:nth-child(2) img {
            width: 60px;
        }

        .blog-posts-container button {
            padding: 5px 10px;
            font-size: 12px;
        }

        .blog-posts-container p {
            font-size: 14px;
        }
    }
</style>

<div class="blog-posts-container">
<?php
$sql = "SELECT id, title, image, created_at FROM blog_posts ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['title']) . "</td>
                <td><img src='Uploads/" . htmlspecialchars($row['image']) . "' alt='Blog Image'></td>
                <td>" . htmlspecialchars($row['created_at']) . "</td>
                <td><button onclick='deleteBlogPost(" . htmlspecialchars($row['id']) . ")'>Delete</button></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No blog posts found.</p>";
}

$conn->close();
?>
</div>