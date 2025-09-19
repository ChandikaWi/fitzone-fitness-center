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
   
    .manage-users-container * {
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .manage-users-container {
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

    .dark-theme .manage-users-container {
        --bg-card: rgba(31, 41, 55, 0.1);
        --text-primary: #f9fafb;
        --border-color: #374151;
    }

    .manage-users-container h2 {
        max-width: 1000px;
        margin: 20px auto;
        font-size: 24px;
        font-weight: 600;
        color: var(--text-primary);
        text-align: left;
    }

    .manage-users-container table {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto 20px;
        border-collapse: collapse;
        background: var(--bg-card);
        backdrop-filter: blur(5px);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    .manage-users-container th {
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

    .manage-users-container td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
        font-size: 16px;
        color: var(--text-primary);
    }

    .manage-users-container tr:last-child td {
        border-bottom: none;
    }

    .manage-users-container tr:nth-child(even) {
        background: rgba(255, 255, 255, 0.05);
    }

    .dark-theme .manage-users-container tr:nth-child(even) {
        background: rgba(31, 41, 55, 0.05);
    }

    .manage-users-container tr:hover {
        background: rgba(220, 38, 38, 0.1);
        transition: background var(--transition-base);
    }

    .manage-users-container button {
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

    .manage-users-container button:hover {
        background: var(--primary-dark);
    }

    .manage-users-container button:focus {
        outline: 2px solid var(--primary-light);
        outline-offset: 2px;
    }

    .manage-users-container a {
        text-decoration: none;
    }

    .manage-users-container p {
        max-width: 1000px;
        margin: 0 auto 20px;
        padding: 15px;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        text-align: center;
        font-size: 18px;
        color: var(--accent-color);
    }

    .dark-theme .manage-users-container p {
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .manage-users-container table {
            display: block;
            overflow-x: auto;
        }

        .manage-users-container h2 {
            font-size: 20px;
            padding: 0 10px;
        }

        .manage-users-container th,
        .manage-users-container td {
            font-size: 14px;
            padding: 10px;
        }

        .manage-users-container button {
            padding: 6px 12px;
            font-size: 13px;
        }

        .manage-users-container p {
            font-size: 16px;
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        .manage-users-container h2 {
            font-size: 18px;
        }

        .manage-users-container th,
        .manage-users-container td {
            font-size: 12px;
            padding: 8px;
        }

        .manage-users-container button {
            padding: 5px 10px;
            font-size: 12px;
        }

        .manage-users-container p {
            font-size: 14px;
        }
    }
</style>

<div class="manage-users-container">
<?php

echo "<h2>Customers</h2>";
$customer_query = "SELECT id, username FROM customers";
$customers_result = $conn->query($customer_query);

if ($customers_result) {
    if ($customers_result->num_rows > 0) {
        echo "<table>
                <tr><th>ID</th><th>Username</th><th>Action</th></tr>";
        while ($row = $customers_result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['username']) . "</td>
                    <td><a href='delete_user.php?type=customer&id=" . htmlspecialchars($row['id']) . "' onclick=\"return confirm('Are you sure you want to delete this customer?');\">
                        <button>Delete</button>
                    </a></td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No customers found.</p>";
    }
} else {
    echo "<p>Query failed: " . htmlspecialchars($conn->error) . "</p>";
}


echo "<h2>Staff Members</h2>";
$staff_query = "SELECT id, username FROM staff";
$staff_result = $conn->query($staff_query);

if ($staff_result) {
    if ($staff_result->num_rows > 0) {
        echo "<table>
                <tr><th>ID</th><th>Username</th><th>Action</th></tr>";
        while ($row = $staff_result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['username']) . "</td>
                    <td><a href='delete_user.php?type=staff&id=" . htmlspecialchars($row['id']) . "' onclick=\"return confirm('Are you sure you want to delete this staff member?');\">
                        <button>Delete</button>
                    </a></td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No staff members found.</p>";
    }
} else {
    echo "<p>Query failed: " . htmlspecialchars($conn->error) . "</p>";
}

$conn->close();
?>
</div>

<script>
    
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.body.classList.add(savedTheme + '-theme');
</script>