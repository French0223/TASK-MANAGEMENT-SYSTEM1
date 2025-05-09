<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php"); 
    exit();
}

// Include database connection
include(__DIR__ . "/../connection.php");

// Check if database connection is successful
if (!isset($conn)) {
    die("Database connection failed.");
}

// Get current user's ID for message notification
$user_id_query = mysqli_query($conn, "SELECT id FROM users WHERE username = '{$_SESSION['username']}'");
$user_id = mysqli_fetch_assoc($user_id_query)['id'];
$unread_count_query = mysqli_query($conn, "SELECT COUNT(*) as count FROM messages WHERE receiver_id = $user_id AND is_read = 0");
$unread_count = mysqli_fetch_assoc($unread_count_query)['count'];

// Total Users
$user_count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$user_count = mysqli_fetch_assoc($user_count_query)['total'];

// Total Departments
$department_count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM departments");
$department_count = mysqli_fetch_assoc($department_count_query)['total'];

// Total Designations
$designation_count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM designations");
$designation_count = mysqli_fetch_assoc($designation_count_query)['total'];

// Get user activity for new activity panel
$check_column = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'last_login'");
$date_column = mysqli_num_rows($check_column) > 0 ? 'last_login' : 'created_at';
$user_activity_query = "SELECT id, username FROM users ORDER BY $date_column DESC LIMIT 5";
$user_activity_result = mysqli_query($conn, $user_activity_query);

// Original activity query for reference (keeping this in case you need to revert)
$recent_activity_query = "
    SELECT 
        u.username, l.activity, l.activity_time
    FROM user_activity_log l
    JOIN users u ON l.user_id = u.id
    ORDER BY l.activity_time DESC
    LIMIT 10
";
$result = mysqli_query($conn, $recent_activity_query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
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
            <a href="../logout.php" class="logout-btn">Logout</a>
            <img src="../images/7853741_logout_kashifarif_exit_out_close_icon.png" class="loglogo">
        </div>
    </aside>

    <!-- Main Content -->
<main class="content">
    <header>
    <div class="header">
<?php
// Fetch unread notifications count
$notif_count_query = "SELECT COUNT(*) as unread FROM notifications n JOIN users u ON n.user_id = u.id WHERE u.username = '{$_SESSION['username']}' AND n.is_read = 0";
$notif_count_result = mysqli_query($conn, $notif_count_query);
$notif_count = mysqli_fetch_assoc($notif_count_result)['unread'];
?>
<img src="../images/211694_bell_icon.png" class="bell" role="button" onclick="window.location.href='../ADMIN/notification.php'">
<?php if ($notif_count > 0): ?>
    <span class="notification-badge"><?php echo $notif_count; ?></span>
<?php endif; ?>
        
        <?php
        // Count unread messages
        $unread_query = "SELECT COUNT(*) as unread FROM messages WHERE receiver_id = $user_id AND is_read = 0";
        $unread_result = mysqli_query($conn, $unread_query);
        $unread_count = mysqli_fetch_assoc($unread_result)['unread'];
        ?>
        
        <div class="message-icon-container">
            <img src="../images/8678233_message_communication_chat_icon.png" class="message" 
                 role="button" onclick="window.location.href='../ADMIN/messages.php'">
            <?php if ($unread_count > 0): ?>
            <span class="message-badge"><?php echo $unread_count; ?></span>
            <?php endif; ?>
        </div>
    </div>
            <h1 class="hello-admin">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        
    </header>
    <section class="dashboard-cards">
         <div class="card">
            <h3>Total Users</h3>
            <p><?php echo $user_count; ?></p>
            <img src="https://cdn0.iconfinder.com/data/icons/users-android-l-lollipop-icon-pack/24/group2-512.png">
        </div>
        <div class="card">
            <h3>Departments</h3>
            <p><?php echo $department_count; ?></p>
            <img src="https://cdn4.iconfinder.com/data/icons/48-bubbles/48/03.Office-1024.png">
        </div>
        <div class="card">
             <h3>Designations</h3>
            <p><?php echo $designation_count; ?></p>
            <img src="https://cdn0.iconfinder.com/data/icons/phosphor-light-vol-4/256/suitcase-light-512.png">
         </div>
    </section>  

   <!-- Recent User Activity -->
<section class="recent-activity-panel">
    <h2>Recent User Activity</h2>
    
    <?php
    // Reset the result pointer to make sure we start from the beginning
    mysqli_data_seek($result, 0);
    
    if (mysqli_num_rows($result) > 0) {
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $count++;
            // For users 1, 3, 5 - show Update button
            // For users 2, 4 - show Login button
            $button_type = ($count % 2 == 0) ? 'Login' : 'Update';
            
            echo '<div class="activity-row">';
            echo '  <div class="activity-info">';
            echo '    <div class="user-name">'. htmlspecialchars($row['username']) .' '. htmlspecialchars($row['activity']) .'</div>';
            echo '    <div class="activity-subtitle">Recent User Activity</div>';
            echo '  </div>';
            echo '  <div class="activity-action">';
            echo '    <button class="btn-'. strtolower($button_type) .'">'. $button_type .'</button>';
            echo '  </div>';
            echo '</div>';
        }
    } else {
        echo '<p>No recent user activity</p>';
    }
    ?>
</section>
</main>

</body>
</html>
