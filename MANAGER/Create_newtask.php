<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Create_task.css">
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

    <div class="boxnisiya-container">
        <div class="boxnisiya">
            <img src="https://th.bing.com/th/id/OIP.0r_Yptp1denh0qR_YHt-LAHaHa?rs=1&pid=ImgDetMain" class="close-btn" role="button" onclick="alert('Button clicked!')">
            <h1>Add New User</h1>
            <h3 class="Mcreate">Add a new user to the system. Fill in all required fields </h3>
            <form method="POST" action="add_user.php">
                <div class="form-group">
                     <label for="Title">Title:</label>
                     <input type="text" id="Title" name="Title" required>
                </div>
                <div class="form-group">
                    <label for="Description">Description:</label>
                    <input type="text" id="Description" name="Description" required>
                </div>
                <div class="form-group">
                    <label for="Project">Project:</label>
                    <select id="Project" name="Project" required>
                        <option value="Admin">ambot</option>
                        <option value="User">ambotr</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Assignees">Assignees:</label>
                    <select id="Assignees" name="Assignees" required>
                        <option value="Admin">ambot</option>
                        <option value="User">ambotr</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Due date">Due date:</label>
                    <input type="Date" id="Date" name="Date" required>
                </div>
                <div class="form-group">
                    <label for="Priority">Priority:</label>
                    <select id="Priority" name="Priority" required>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="low">low</option>
                    </select>
                </div>
            <div class="button-container">
                <button class="c" type="submit">Cancel</button>
                <button type="submit">Create Task</button>
            </div>
        </form>
        </div>
    </div>
