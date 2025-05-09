<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" type="text/css" href="../css/sidebardesign.css">
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
            <img src="../images/211694_bell_icon.png" class="bell" role="button" onclick="alert('Button clicked!')">
            <img src="../images/8678233_message_communication_chat_icon.png" class="message" role="button" onclick="alert('Button clicked!')">
        </div>

        <!-- User List Section -->
        <section class="user-list">
            <h2>Designation Management</h2>
            <div class="bastaword-wrapper">
                <h3 class="bastaword">Create and manage job designations in your organization</h3>
                    <div class="adduser" role="button" onclick="window.location.href='add_user.php'">
                        <img src="../images/1814113_add_more_plus_icon.png" class="addb">
                        <p class="useradd">Add department</p>
                    </div>
                </div>
            <div class="search-bar">
                <input class="ins" type="text" placeholder="Search users...">
            </div>

            <table border="0">
                <tr>
                    <th>Department Name</th>
                    <th>Description</th>
                    <th>Employees</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM departments");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td data-label='Department Name'>{$row['name']}</td>
                        <td data-label='Description'>{$row['description']}</td>
                        <td data-label='Employees'>-</td> <!-- You can update this later to count users in that department -->
                        <td data-label='Created At'>{$row['created_at']}</td>
                        <td data-label='Actions'>
                            <a href='edit_department.php?id={$row['id']}'>Edit</a> 
                            <a href='delete_department.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
                }                
                ?>
            </table>
        </section>
    </main>


<?php mysqli_close($conn); ?>

</body>
</html>
