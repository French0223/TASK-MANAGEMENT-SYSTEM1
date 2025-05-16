<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="task.css">
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

    <main class="content">
    <header>
    <div class="header">
        <img src="../images/211694_bell_icon.png" class="bell" role="button" onclick="window.location.href='../ADMIN/notification.php'">
        <img src="../images/8678233_message_communication_chat_icon.png" class="message" role="button" onclick="window.location.href='../ADMIN/messages.php'">
    </div>
    </header>

    <!-- User List Section -->
        <section class="user-list scrollable-content">
            <h2>Task Assignment</h2>
            <div class="bastaword-wrapper">
                <h3 class="bastaword">Create and assign tasks to team members</h3>
            </div>
            <div class="search-bar">
                <input id="departmentSearch" class="ins" type="text" placeholder="Search departments...">
                <select class="ambot" name="statusFilter" id="statusFilter">
                    <option value="completed">Completed</option>
                    <option value="archived">Archived</option>
                </select>

                <select class="ambot" name="statusFilter" id="statusFilter">
                    <option value="completed">Completed</option>
                    <option value="archived">Archived</option>
                </select>

                <div class="adduser" role="button" onclick="window.location.href='add_department.php'">
                    <img src="../images/1814113_add_more_plus_icon.png" class="addb">
                    <p class="useradd">New Task</p>
                </div>

            </div>

            <table border="0">
                <tr>
                    <th>Task</th>
                    <th>Project</th>
                    <th>Assignees</th>
                    <th>Due date</th>
                    <th>Status</th>
                    <th>Priority</th>
                </tr>
            </table>
        </section>
        </main>