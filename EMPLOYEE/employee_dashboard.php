<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'employee') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/employee.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Prodify.</h2>
        <ul>
            <li class="active"><i class="fas fa-home"></i> <a href="employee_dashboard.php">Dashboard</a></li>
            <li><i class="fas fa-tasks"></i> <a href="tasks.php">My Tasks</a></li>
            <li><i class="fas fa-calendar"></i> <a href="schedule.php">Schedule</a></li>
            <li><i class="fas fa-user"></i> <a href="profile.php">Profile</a></li>
        </ul>
        <div class="logout">
            <i class="fas fa-user-circle"></i> @Employee
            <a href="../logout.php" class="logout-btn">Logout</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="content">
        <header>
            <h1>Hello Employee</h1>
        </header>

        <section class="buttons">
            <a href="tasks.php" class="btn">My Tasks</a>
            <a href="schedule.php" class="btn">Schedule</a>
            <a href="profile.php" class="btn">Profile</a>
        </section>

        <!-- Calendar Section -->
        <section class="calendar">
            <iframe src="calendar.php"></iframe>
        </section>
    </main>

</body>
</html>
