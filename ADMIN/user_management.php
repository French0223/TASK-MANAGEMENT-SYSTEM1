<?php include_once '../connection.php';  // Prevent header already sent error ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" type="text/css" href="user.css">
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
            <img src="../images/9035967_people_sharp_icon.png" class="userni">
            <img src="../images/290138_document_extension_file_format_paper_icon.png" class="roleni">
            <img src="../images/7067453_building_office_property_icon.png" class="department">
            <img src="../images/134228_briefcase_career_business_suitcase_icon.png" class="designation">
            <img src="../images/8665306_circle_user_icon.png" class="profile1">
        </div>
        <ul>
            <li class="active"><i class="fas fa-home"></i> <a href="admin_dashboard.php">Dashboard</a></li>
            <li><i class="fas"></i> <a href="user_management.php">User Management</a></li>
            <li><i class="fas"></i> <a href="role_assignment.php">Role Assignment</a></li>
            <li><i class="fas"></i> <a href="department_management.php">Department<br />Management</a></li>
            <li><i class="fas fa-briefcase"></i> <a href="designation_management.php">Designation<br />Management<br /></a></li>
        </ul>
        <div class="logout">
            <i class="fasfa-user-circle">@Admin</i>
            <a href="logout.php" class="logout-btn">Logout</a>
            <img src="../images/7853741_logout_kashifarif_exit_out_close_icon.png" class="loglogo">
        </div>
    </aside>

    <!-- Main Content -->
    <main class="content">
        <header>
            <div class="header">
                <img src="../images/211694_bell_icon.png" class="bell" role="button" onclick="alert('Button clicked!')">
                <img src="../images/8678233_message_communication_chat_icon.png" class="message" role="button" onclick="alert('Button clicked!')">
            </div>
            <div class="userm">
                <h1 class="UserMa">User management</h1>
                <div class="adduser" role="button" onclick="window.location.href='add_user.php'">
                    <p class="useradd">Add user</p>
                    <img src="../images/1814113_add_more_plus_icon.png" class="addb">
                </div>
                <div class="searchboarder">
                    <input class="ins" type="text" placeholder="Search users...">
                    <img src="https://icon-library.com/images/search-bar-icon-png/search-bar-icon-png-16.jpg" class="glass">
                </div>
              <div class="boarder">
    <div class="table-header">
        <p class="name">Name</p>
        <p class="email">Email</p>
        <p class="role">Role</p>
        <p class="status1">Status</p>
        <p class="action">Action</p>
    </div>

    <?php
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='user-row'>";
            echo "<p class='user1'>" . htmlspecialchars($row['username']) . "</p>";
            echo "<p class='email1'>" . htmlspecialchars($row['email']) . "</p>";
            echo "<p class='role1'>" . htmlspecialchars($row['role']) . "</p>";

            // Status Column
            echo "<p class='status'>" . ($row['status'] == 1 ? "Active" : "Inactive") . "</p>";

            // Action buttons
            echo "<p class='action2'><a href='edit_user.php?id=" . $row['id'] . "'>✏️ Edit</a></p>";
            echo "<p class='action3'><a href='user_management.php?deactivate_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to deactivate this user?\")'>🗑️ Deactivate</a></p>";
            echo "</div>";
        }
    } else {
        echo "<p>No users found</p>";
    }
    ?>
</div>

            </div>
        </header>
    </main>

    <?php
    // Deactivate user
    if (isset($_GET['deactivate_id'])) {
        $id = $_GET['deactivate_id'];
        $query = "UPDATE users SET status = 0 WHERE id = $id";
        mysqli_query($conn, $query);
        header("Location: user_management.php");  // Reload the page to reflect changes
        exit();
    }

    ob_end_flush(); // End output buffering
    ?>
</body>
</html>
