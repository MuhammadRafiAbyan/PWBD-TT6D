<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$last_login_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$last_login_user = mysqli_fetch_assoc($last_login_query);

$all_users_query = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            document.getElementById('live-clock').textContent = timeString;
        }
        setInterval(updateClock, 1000);
    </script>
</head>
<body>
    <div class="container">
        <h1>Selamat datang, <?php echo $_SESSION['username']; ?>!</h1>
        <div id="live-clock" class="clock"></div>
        <h2>User Terakhir Login</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
            </tr>
            <tr>
                <td><?php echo $last_login_user['id']; ?></td>
                <td><?php echo $last_login_user['username']; ?></td>
            </tr>
        </table>
        <h2>Seluruh User</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
            </tr>
            <?php while ($user = mysqli_fetch_assoc($all_users_query)) { ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
            </tr>
            <?php } ?>
        </table>
        <a href="logout.php">Logout</a>
    </div>
</body>
<style>
    body {
        background-color: #0f0f0f;
        color: #0fff50;
        font-family: Arial, sans-serif;
        text-align: center;
    }
    .container {
        margin-top: 20px;
    }
    .clock {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    table {
        width: 50%;
        margin: 20px auto;
        border-collapse: collapse;
        background: black;
        box-shadow: 0px 0px 10px 2px #0fff50;
    }
    th, td {
        padding: 10px;
        border: 1px solid #0fff50;
        color: #0fff50;
    }
    th {
        background-color: #0fff50;
        color: black;
    }
    a {
        background-color: #0fff50;
        color: #ff073a;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s;
    }
    a:hover {
        background-color: #09cc40;
        color: #ff455e;
    }
</style>
</html>
