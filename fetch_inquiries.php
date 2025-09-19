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

if (!isset($_SESSION["username"])) {
    header("Location: LoginForm.html");
    exit();
}
?>

<style>
   
    .contact-inquiries-container * {
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .contact-inquiries-container {
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

    .dark-theme .contact-inquiries-container {
        --bg-card: rgba(31, 41, 55, 0.1);
        --text-primary: #f9fafb;
        --border-color: #374151;
    }

    .contact-inquiries-container table {
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

    .contact-inquiries-container th {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
        font-size: 16px;
        background: var(--gradient-primary);
        color: var(--text-inverse);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .contact-inquiries-container td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
        font-size: 16px;
        color: var(--text-primary);
    }

    .contact-inquiries-container td:nth-child(3) {
        text-align: left;
        max-width: 300px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .contact-inquiries-container tr:last-child td {
        border-bottom: none;
    }

    .contact-inquiries-container tr:nth-child(even) {
        background: rgba(255, 255, 255, 0.05);
    }

    .dark-theme .contact-inquiries-container tr:nth-child(even) {
        background: rgba(31, 41, 55, 0.05);
    }

    .contact-inquiries-container tr:hover {
        background: rgba(220, 38, 38, 0.1);
        transition: background var(--transition-base);
    }

    .contact-inquiries-container p {
        max-width: 1000px;
        margin: 20px auto;
        padding: 15px;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        text-align: center;
        font-size: 18px;
        color: var(--accent-color);
    }

    .dark-theme .contact-inquiries-container p {
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .contact-inquiries-container table {
            display: block;
            overflow-x: auto;
        }

        .contact-inquiries-container th,
        .contact-inquiries-container td {
            font-size: 14px;
            padding: 10px;
        }

        .contact-inquiries-container td:nth-child(3) {
            max-width: 200px;
        }

        .contact-inquiries-container p {
            font-size: 16px;
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        .contact-inquiries-container th,
        .contact-inquiries-container td {
            font-size: 12px;
            padding: 8px;
        }

        .contact-inquiries-container td:nth-child(3) {
            max-width: 150px;
        }

        .contact-inquiries-container p {
            font-size: 14px;
        }
    }
</style>

<div class="contact-inquiries-container">
<?php

$sql = "SELECT name, email, message, submitted_at FROM contact_messages ORDER BY submitted_at DESC";
$result = $conn->query($sql);


if ($result && $result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Email</th><th>Message</th><th>Submitted At</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["message"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["submitted_at"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No inquiries found.</p>";
}

$conn->close();
?>
</div>

<script>
    
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.body.classList.add(savedTheme + '-theme');
</script>