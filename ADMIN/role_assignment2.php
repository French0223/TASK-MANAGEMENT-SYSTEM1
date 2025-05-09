<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "database1"); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get users and their roles, handling missing departments
$sql = "SELECT users.id, users.username, users.email, users.role AS role_name, 
        IFNULL(departments.name, 'No Department') AS department_name
        FROM users 
        LEFT JOIN departments ON users.designation_id = departments.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/Role_Assignment2.css">
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
            <li><i class="fas fa-home"></i> <a href="admin_dashboard.php">Dashboard</a></li>
            <li><i class="fas"></i> <a href="user_management.php">User Management</a></li>
            <li><i class="fas"></i> <a href="role_assignment2.php">Role Assignment</a></li>
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
            <img src="../images/211694_bell_icon.png" class="bell" role="button" onclick="window.location.href='notifications.php'" alt="Notifications">
            <img src="../images/8678233_message_communication_chat_icon.png" class="message" role="button" onclick="window.location.href='message.php'" alt="Messages">
        </div>
        
    </header>
    <div class="box">
    <p class="word">Role Assignment</p>
    <p class="word1">Assigned Roles and Permission to users in the system.</p>
    <p class="word2">Select user</p>

    <img src="../images/3643745_human_man_people_person_profile_icon.png" class="human">

    <div class="minib">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="box1">
                <div class="top-row">
                    <p class="U"><?= htmlspecialchars($row['username']) ?></p>
                    <div class="supervisor" role="button" onclick="window.location.href='edit_role.php?user_id=<?= $row['id'] ?>'">
                        <img src="../images/9036002_shield_sharp_icon.png" class="superb">
                        <p class="S"><?= htmlspecialchars($row['role_name']) ?></p>
                    </div>
                </div>
                    <p class="G"><?= htmlspecialchars($row['email']) ?></p>
                     <p class="Eg"><?= htmlspecialchars($row['department_name']) ?></p>
                </div>

        <?php endwhile; ?>
    </div>
    
    <img src="../images/1e3ca269-6619-499e-8b62-6c690a4097b3.png" class="add" role="button" onclick="window.location.href='edit_role.php';">
    <p class="w">Select User to assign roles and permission</p>
</div>
</main>
</body>
</html>
<?php
$conn->close();
?>
<link rel="stylesheet" href="../css/Role_Assignment2.css">