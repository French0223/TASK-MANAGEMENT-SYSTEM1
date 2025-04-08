<?php
include_once '../connection.php';

// Fetch user data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated data from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $status = $_POST['status'];  // 1 = Active, 0 = Inactive

    // Update user in database
    $update_query = "UPDATE users SET username = '$username', email = '$email', role = '$role', status = $status WHERE id = $id";
    mysqli_query($conn, $update_query);

    // Redirect to user management page
    header("Location: user_management.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="../css/edituser.css">
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
            </div> 
        <div class="boxnisiya">
        <img src="https://th.bing.com/th/id/OIP.0r_Yptp1denh0qR_YHt-LAHaHa?rs=1&pid=ImgDetMain" class="close-btn" role="button" onclick="alert('Button clicked!')">
            <h1>Edit User</h1>
            <h3 class="Mcreate">Edit user to the system. Fill in all required fields </h3>

<f method="POST" action="edit_user.php?id=<?php echo $user['id']; ?>">
    <div class="form-group"> 
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
    </div>
    <div class="form-group">    
         <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    </div>
    <div class="form-group">
    <select name="role">
        <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
        <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
    </select>
    </div>
    <div class="form-group">
    <select name="status">
        <option value="1" <?php if ($user['status'] == 1) echo 'selected'; ?>>Active</option>
        <option value="0" <?php if ($user['status'] == 0) echo 'selected'; ?>>Inactive</option>
    </select>
    </div>

    <button type="submit">Update User</button>
</form>
</div>
</header>
    </main>
