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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="manager_dash.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400..800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
        <img src="../images/134216_menu_lines_hamburger_icon.png" class="menu">
        <h2 class="sidebarh2">Prodify.</h2>
        <div class="sidebar-header">
            <img src="../images/9055226_bxs_dashboard_icon.png" class="dashboard">
            <img src="../images/290138_document_extension_file_format_paper_icon.png" class="userni">
            <img src="https://cdn.iconfinder.com/stored_data/2251574/128/png?token=1747236484-LkBkZ4uoVeDdSbKJVbY0SSTQsO4EbvWIatLUGMTFF6w%3D" class="roleni">
            <img src="../images/9035967_people_sharp_icon.png" class="department">
            <img src="../images/8665306_circle_user_icon.png" class="profile1">
        </div>
        <ul>
            <li><i class="fas fa-home"></i> <a href="manager_dashboard.php">Dashboard</a></li>
            <li><i class="fas"></i> <a href="project.php">Project</a></li>
            <li><i class="fas"></i> <a href="task_assignment.php">Task Assignment</a></li>
            <li><i class="fas"></i> <a href="user_manager.php">Users</a></li>
        </ul>
        <div class="logout">
            <i class="fasfa-user-circle">@Manager</i>
            <a href="../logout.php" class="logout-btn">Logout</a>
            <img src="../images/7853741_logout_kashifarif_exit_out_close_icon.png" class="loglogo">
        </div>
    </aside>

    <!-- Main Content -->
<main class="content">
    <header>
    <div class="header">
        <img src="../images/211694_bell_icon.png" class="bell" role="button" onclick="window.location.href='../ADMIN/notification.php'">
        <img src="../images/8678233_message_communication_chat_icon.png" class="message" role="button" onclick="window.location.href='../ADMIN/messages.php'">
    </div>
    </header>

    <h1 class="hello-admin">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <section class="dashboard-cards">
         <div class="card">
            <h2>Active Projects</h2>
            <h3>Projects ahead of schedule</h3>
            <p>0</p>
            <img src="https://cdn4.iconfinder.com/data/icons/48-bubbles/48/12.File-1024.png">
        </div>
        <div class="card">
            <h2>Pending Task</h2>
            <h3>Tasks require attention</h3>
            <p>0</p>
            <img src="https://cdn4.iconfinder.com/data/icons/basic-ui-2-line/32/clock-time-ticker-times-hour-512.png">
        </div>
        <div class="card">
            <h2>Team Members</h2>
            <h3>Across all projects</h3>
            <p>0</p>
            <img src="https://cdn0.iconfinder.com/data/icons/users-android-l-lollipop-icon-pack/24/group2-512.png">
         </div>
    </section>  

   <!-- Recent User Activity -->
<div class="recent-activity-wrapper">
<section class="recent-activity-panel">
    <div class="recent-activity-header">
        <img src="https://cdn4.iconfinder.com/data/icons/essentials-71/24/011_-_Calendar-512.png" alt="User Icon" />
        <h2>Upcoming deadline</h2>
    </div>
    <p>No recent user activity</p>
</section>

<section class="recent-activity-panel2">
    <h2><img src="https://cdn3.iconfinder.com/data/icons/social-media-2125/80/timeline-512.png">Team Activity</h2>
    <p>No recent user activity</p>
</section>
</div>
</main>

</body>
</html>