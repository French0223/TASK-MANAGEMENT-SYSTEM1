<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php"); // Redirect to login page if not admin
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400..800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Prodify.</h2>
        </div>
        <ul>
            <li class="active"><i class="fas fa-home"></i> <a href="admin_dashboard.php">Dashboard</a></li>
            <li><i class="fas fa-users"></i> <a href="user_management.php">User Management</a></li>
            <li><i class="fas fa-user-shield"></i> <a href="role_assignment.php">Role Assignment</a></li>
            <li><i class="fas fa-building"></i> <a href="department_management.php">Department Management</a></li>
            <li><i class="fas fa-briefcase"></i> <a href="designation_management.php">Designation Management</a></li>
        </ul>
        <div class="logout">
            <i class="fas fa-user-circle"></i> @Admin
            <br>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="content">
        <header>
        <div class="header"></div>
        <h1 class="hello-admin">Hello Admin</h1>
        </header>

        <!-- Dashboard Cards -->
        <section class="dashboard-cards">
            <div class="card">
                <h3>Total Users</h3>
                <p>23</p>
            </div>
            <div class="card">
                <h3>Departments</h3>
                <p>8</p>
            </div>
            <div class="card">
                <h3>Designations</h3>
                <p>12</p>
            </div>
        </section>
    </main>

</body>
</html>
