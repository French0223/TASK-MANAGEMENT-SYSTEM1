<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="user_manager.css">
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
            <h2>
                <img src="../images/8665306_circle_user_icon.png" alt="User Icon" class="user-icon" />
                Users
            </h2>
            <div class="search-bar">
                <img src="../images/5402443_search_find_magnifier_magnifying_magnifying glass_icon.png" alt="Search Icon" class="search-icon" />
                <input id="departmentSearch" class="ins" type="text" placeholder="Search users...">
            </div>

            <table border="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Frenchie</td>
                        <td>Admin</td>
                        <td><img src="https://cdn4.iconfinder.com/data/icons/glyphs/24/icons_email-512.png" alt="Message Icon" class="message-icon" /></td>
                    </tr>
                    <tr>
                        <td>Precious</td>
                        <td>Manager</td>
                        <td><img src="https://cdn4.iconfinder.com/data/icons/glyphs/24/icons_email-512.png" alt="Message Icon" class="message-icon" /></td>
                    </tr>
                    <tr>
                        <td>Christian</td>
                        <td>User</td>
                        <td><img src="https://cdn4.iconfinder.com/data/icons/glyphs/24/icons_email-512.png" alt="Message Icon" class="message-icon" /></td>
                    </tr>
                </tbody>
            </table>
        </section>
        </main>
