<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'supervisor') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Prodify.</h2>
        <ul>
            <li class="active"><i class="fas fa-home"></i> <a href="supervisor_dashboard.php">Dashboard</a></li>
            <li><i class="fas fa-tasks"></i> <a href="task_supervision.php">Task Supervision</a></li>
            <li><i class="fas fa-user-check"></i> <a href="employee_performance.php">Employee Performance</a></li>
            <li><i class="fas fa-calendar-check"></i> <a href="schedule.php">Schedule</a></li>
        </ul>
        <div class="logout">
            <i class="fas fa-user-circle"></i> @Supervisor
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="content">
        <header>
            <h1>Hello, Supervisor</h1>
        </header>

        <section class="buttons">
            <a href="task_supervision.php" class="btn">Task Supervision</a>
            <a href="employee_performance.php" class="btn">Employee Performance</a>
            <a href="schedule.php" class="btn">Schedule</a>
        </section>

        <!-- Calendar Section -->
        <section class="calendar">
            <iframe src="calendar.php"></iframe>
        </section>
    </main>

</body>
</html>
