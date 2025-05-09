<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}
include(__DIR__ . "/../connection.php");

$user_query = $conn->prepare("SELECT id FROM users WHERE username = ?");
$user_query->bind_param("s", $_SESSION['username']);
$user_query->execute();
$user_result = $user_query->get_result();
if ($user_result->num_rows === 0) {
    die("User not found");
}
$user = $user_result->fetch_assoc();
$user_id = $user['id'];

$notif_query = $conn->prepare("SELECT message, created_at, is_read FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
$notif_query->bind_param("i", $user_id);
$notif_query->execute();
$notif_result = $notif_query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Notifications</title>
    <link rel="stylesheet" type="text/css" href="../css/notification.css" />
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400..800&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        function markAllRead() {
            fetch('mark_read.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to mark notifications as read');
                    }
                });
        }
    </script>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <img src="../images/134216_menu_lines_hamburger_icon.png" class="menu" />
        <h2 class="sidebarh2">Prodify.</h2>
        <div class="sidebar-header">
            <img src="../images/9055226_bxs_dashboard_icon.png" class="dashboard" />
            <img src="../images/9035967_people_sharp_icon.png" class="userni" />
            <img src="../images/290138_document_extension_file_format_paper_icon.png" class="roleni" />
            <img src="../images/7067453_building_office_property_icon.png" class="department" />
            <img src="../images/134228_briefcase_career_business_suitcase_icon.png" class="designation" />
            <img src="../images/8665306_circle_user_icon.png" class="profile1" />
        </div>
        <ul>
            <li><i class="fas fa-home"></i> <a href="admin_dashboard.php">Dashboard</a></li>
            <li><i class="fas"></i> <a href="user_management.php">User Management</a></li>
            <li><i class="fas"></i> <a href="role_assignment2.php">Role Assignment</a></li>
            <li><i class="fas"></i> <a href="department_management.php">Department<br />Management</a></li>
            <li><i class="fas fa-briefcase"></i> <a href="designation_management.php">Designation<br />Management<br /></a></li>
        </ul>
        <div class="logout">
            <i class="fas fa-user-circle">@Admin</i>
            <a href="logout.php" class="logout-btn">Logout</a>
            <img src="../images/7853741_logout_kashifarif_exit_out_close_icon.png" class="loglogo" />
        </div>
    </aside>

    <main class="content">
        <header>
        <div class="header">
        <img src="../images/8678233_message_communication_chat_icon.png" class="message" role="button" onclick="alert('Button clicked!')">
        <img src="../images/211694_bell_icon.png" class="bell" role="button" onclick="alert('Button clicked!')">
        </div>
        
        <main>
            <section class="box">
            <h2 class="word">NOTIFICATION</h2>

        <div style="text-align: right; margin-right: 50px; margin-bottom: 10px;">
            <a href="#" class="mark-read" onclick="markAllRead()">Mark all as read</a>
        </div>

        <div class="minib">
            <?php while ($row = $notif_result->fetch_assoc()): ?>
                <div class="box1" style="background-color: <?php echo $row['is_read'] ? '#f0f0f0' : '#d1e7dd'; ?>;">
                    <p class="U"><?php echo htmlspecialchars($row['message']); ?></p>
                    <p class="G"><?php echo date('M d, Y H:i', strtotime($row['created_at'])); ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <!--<div class="notif-footer">
            <a href="#" class="view-all">View All</a>
        </div>-->
    </section>
</main>

</body>
</html>

