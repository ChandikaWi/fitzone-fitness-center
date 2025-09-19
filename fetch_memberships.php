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
   
    .customer-memberships-container * {
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .customer-memberships-container {
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

    .dark-theme .customer-memberships-container {
        --bg-card: rgba(31, 41, 55, 0.1);
        --text-primary: #f9fafb;
        --border-color: #374151;
    }

    .customer-memberships-container table {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        border-collapse: collapse;
        background: var(--bg-card);
        backdrop-filter: blur(5px);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    .customer-memberships-container th {
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

    .customer-memberships-container td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
        font-size: 16px;
        color: var(--text-primary);
    }

    .customer-memberships-container tr:last-child td {
        border-bottom: none;
    }

    .customer-memberships-container tr:nth-child(even) {
        background: rgba(255, 255, 255, 0.05);
    }

    .dark-theme .customer-memberships-container tr:nth-child(even) {
        background: rgba(31, 41, 55, 0.05);
    }

    .customer-memberships-container tr:hover {
        background: rgba(220, 38, 38, 0.1);
        transition: background var(--transition-base);
    }

    .customer-memberships-container p {
        max-width: 800px;
        margin: 20px auto;
        padding: 15px;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        text-align: center;
        font-size: 18px;
        color: var(--accent-color);
    }

    .dark-theme .customer-memberships-container p {
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .customer-memberships-container table {
            display: block;
            overflow-x: auto;
        }

        .customer-memberships-container th,
        .customer-memberships-container td {
            font-size: 14px;
            padding: 10px;
        }

        .customer-memberships-container p {
            font-size: 16px;
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        .customer-memberships-container th,
        .customer-memberships-container td {
            font-size: 12px;
            padding: 8px;
        }

        .customer-memberships-container p {
            font-size: 14px;
        }
    }
</style>

<div class="customer-memberships-container">
<?php
$username = $_SESSION["username"];

$stmt = $conn->prepare("SELECT membership_type, price, purchased_at FROM customer_memberships WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table>
            <tr><th>Membership</th><th>Price</th><th>Purchased At</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . htmlspecialchars($row["membership_type"]) . "</td>
                  <td>Rs. " . number_format($row["price"], 2) . "</td>
                  <td>" . htmlspecialchars($row["purchased_at"]) . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No memberships purchased yet.</p>";
}

$stmt->close();
$conn->close();
?>
</div>

<script>
    
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.body.classList.add(savedTheme + '-theme');
</script>