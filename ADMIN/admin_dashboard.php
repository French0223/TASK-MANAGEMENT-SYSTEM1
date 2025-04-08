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

// Fetch total user count
$user_count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$user_count = mysqli_fetch_assoc($user_count_query)['total'];
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

<aside class="sidebar">
    <img src="../images/134216_menu_lines_hamburger_icon.png" class="menu">    
    <img src="../images/8665306_circle_user_icon.png" class="profile1">
    <div class="sidebar-header">
        <h2>Prodify.</h2>
    </div>

    <ul class="nav-links">
        <li>
            <img src="../images/9055226_bxs_dashboard_icon.png" class="icon">
            <a href="admin_dashboard.php">Dashboard</a>
        </li>
        <li>
            <img src="../images/9035967_people_sharp_icon.png" class="icon">
            <a href="user_management.php">User Management</a>
        </li>
        <li>
            <img src="../images/290138_document_extension_file_format_paper_icon.png" class="icon">
            <a href="role_assignment.php">Role Assignment</a>
        </li>
        <li>
            <img src="../images/7067453_building_office_property_icon.png" class="icon">
            <a href="department_management.php">Department Management</a>
        </li>
        <li>
            <img src="../images/134228_briefcase_career_business_suitcase_icon.png" class="icon">
            <a href="designation_management.php">Designation Management</a>
        </li>
    </ul>

    <div class="logout">
            <i class="fasfa-user-circle">@Admin</i>
            <a href="logout.php" class="logout-btn">Logout</a>
            <img src="../images/7853741_logout_kashifarif_exit_out_close_icon.png" class="loglogo">
        </div>
</aside>

    <main class="content">
        <header>
            <div class="header">
                <img src="../images/211694_bell_icon.png" class="bell" role="button" onclick="alert('Button clicked!')">
                <img src="../images/8678233_message_communication_chat_icon.png" class="message" role="button" onclick="alert('Button clicked!')">
            </div>

            <h1 class="hello-admin">Hello Admin</h1>
        
        </header>
        <section class="dashboard-cards">
            <div class="card">
                <h3>Total Users</h3>
                <p><?php echo $user_count; ?></p>
            </div>
            <div class="card">
                <h3>Departments</h3>
                <p>8</p>
            </div>
            <div class="card">
                <h3>Designations</h3>
                <p>12</p>
            </div>
        </section>

        <!-- User List Section -->
        <section class="user-list">
            <h2>Department Management</h2>
            <div class="bastaword-wrapper">
                <h3 class="bastaword">Create and manage departments in your organization</h3>
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
                $result = mysqli_query($conn, "SELECT * FROM users");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td data-label='ID'>{$row['id']}</td>
                        <td data-label='Username'>{$row['username']}</td>
                        <td data-label='Role'>{$row['role']}</td>
                        <td data-label='Created At'>{$row['created_at']}</td>
                        <td data-label='Actions'>
                            <a href='edit_user.php?id={$row['id']}'>Edit</a> 
                            <a href='delete_user.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    </td>
                    </tr>";
                }
                ?>
            </table>
        </section>
    </main>

</body>
</html>
<link rel="stylesheet" href="../css/global.css">
<link rel="stylesheet" href="../css/admin.css">