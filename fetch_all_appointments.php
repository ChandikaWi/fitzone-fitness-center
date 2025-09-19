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
    .all-appointments-container * {
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .all-appointments-container {
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

    .dark-theme .all-appointments-container {
        --bg-card: rgba(31, 41, 55, 0.1);
        --text-primary: #f9fafb; 
        --border-color: #374151;
    }

    .all-appointments-container table {
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

    .all-appointments-container th {
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

    .all-appointments-container td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
        font-size: 16px;
        color: var(--text-primary); 
    }

    .all-appointments-container tr:last-child td {
        border-bottom: none;
    }

    .all-appointments-container tr:nth-child(even) {
        background: rgba(255, 255, 255, 0.05);
    }

    .dark-theme .all-appointments-container tr:nth-child(even) {
        background: rgba(31, 41, 55, 0.05);
    }

    .all-appointments-container tr:hover {
        background: rgba(220, 38, 38, 0.1);
        transition: background var(--transition-base);
    }

    .all-appointments-container p {
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

    .dark-theme .all-appointments-container p {
        color: var(--text-primary); 
    }

    @media (max-width: 768px) {
        .all-appointments-container table {
            display: block;
            overflow-x: auto;
        }

        .all-appointments-container th,
        .all-appointments-container td {
            font-size: 14px;
            padding: 10px;
        }

        .all-appointments-container p {
            font-size: 16px;
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        .all-appointments-container th,
        .all-appointments-container td {
            font-size: 12px;
            padding: 8px;
        }

        .all-appointments-container p {
            font-size: 14px;
        }
    }
</style>

<div class="all-appointments-container">
<?php
$sql = "SELECT id, username, service, trainer, date, time FROM gym_appointments ORDER BY date, time";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Customer ID</th>
                <th>Username</th>
                <th>Service</th>
                <th>Trainer</th>
                <th>Date</th>
                <th>Time</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["id"]) . "</td>
                <td>" . htmlspecialchars($row["username"]) . "</td>
                <td>" . htmlspecialchars($row["service"]) . "</td>
                <td>" . htmlspecialchars($row["trainer"]) . "</td>
                <td>" . htmlspecialchars($row["date"]) . "</td>
                <td>" . htmlspecialchars($row["time"]) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No appointments found.</p>";
}

$conn->close();
?>
</div>

<script>
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.body.classList.add(savedTheme + '-theme');
</script>