<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'manager') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/manager.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>
<body>

    <aside class="sidebar">
        <h2>Prodify.</h2>
        <ul>
            <li class="active"><i class="fas fa-home"></i> <a href="manager_dashboard.php">Dashboard</a></li>
            <li><i class="fas fa-users"></i> <a href="team_management.php">Team Management</a></li>
            <li><i class="fas fa-tasks"></i> <a href="tasks.php">Manage Tasks</a></li>
            <li><i class="fas fa-chart-line"></i> <a href="reports.php">Reports</a></li>
        </ul>
        <div class="logout">
            <i class="fas fa-user-circle"></i> @Manager
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </aside>

    <main class="content">
        <header>
            <h1>Hello, Manager</h1>
        </header>

        <section class="buttons">
            <a href="team_management.php" class="btn">Team Management</a>
            <a href="tasks.php" class="btn">Manage Tasks</a>
            <a href="reports.php" class="btn">View Reports</a>
        </section>

        <section class="calendar">
            <iframe src="calendar.php"></iframe>
        </section>
    </main>

</body>
</html>
