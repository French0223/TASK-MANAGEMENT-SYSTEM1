<?php 
include_once '../connection.php';  
ob_start();  // Start output buffering to prevent header issues

// Deactivate user logic placed at the top
if (isset($_GET['deactivate_id'])) {
    $id = $_GET['deactivate_id'];
    $query = "UPDATE users SET status = 0 WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "User deactivated successfully!";
    } else {
        echo "Error" . mysqli_error($conn);
    }
    header("Location: user_management.php");  // Reload the page to reflect changes
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" type="text/css" href="../css/user.css">
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
            <li><i class="fas fa-briefcase"></i> <a href="designation_management.php">Designation<br />Management</a></li>
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
                <img src="../images/211694_bell_icon.png" class="bell" role="button" onclick="window.location.href='notifications.php'" alt="Notifications">
                <img src="../images/8678233_message_communication_chat_icon.png" class="message" role="button" onclick="window.location.href='message.php'" alt="Messages">
            </div>
        </header>

        <!-- User Management Section -->
        <section class="user-list">
            <h2>User Management</h2>
            <div class="bastaword-wrapper">
                <h3 class="bastaword">Create and manage user accounts in your organization</h3>
            </div>

            <div class="search-bar">
                <input id="userSearch" class="ins" type="text" placeholder="Search users...">
                <div class="adduser" role="button" onclick="window.location.href='add_user.php'">
                    <img src="../images/1814113_add_more_plus_icon.png" class="addb">
                    <p class="useradd">Add user</p>
                </div>
            </div>

            <table border="0">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php
                $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

                if ($search != '') {
                    $query = "SELECT * FROM users WHERE username LIKE '%$search%' OR email LIKE '%$search%' OR role LIKE '%$search%'";
                } else {
                    $query = "SELECT * FROM users";
                }

                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status = ($row['status']) ? "Active" : "Inactive";
                        echo "<tr>";
                        echo "<td data-label='Name'>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td data-label='Email'>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td data-label='Role'>" . htmlspecialchars($row['role']) . "</td>";
                        echo "<td data-label='Status'>$status</td>";
                        echo "<td data-label='Actions'>
                                <div class='action-buttons'>
                                    <a href='edit_user.php?id=" . $row['id'] . "'>Edit</a>
                                    <a href='user_management.php?deactivate_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to deactivate this user?\")'>Deactivate</a>
                                </div>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
                ?>
            </table>
        </section>
    </main>

    <?php mysqli_close($conn); ?>
<script>
document.getElementById('userSearch').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('table tr:not(:first-child)');
    rows.forEach(row => {
        const name = row.querySelector('td[data-label="Name"]').textContent.toLowerCase();
        const email = row.querySelector('td[data-label="Email"]').textContent.toLowerCase();
        const role = row.querySelector('td[data-label="Role"]').textContent.toLowerCase();
        if (name.includes(filter) || email.includes(filter) || role.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
</body>
</html>
