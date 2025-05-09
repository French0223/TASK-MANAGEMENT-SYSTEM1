<?php
include('../connection.php');

if (!isset($_GET['id'])) {
    header("Location: designation_management.php");
    exit();
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);

    $update_query = "UPDATE designations SET title='$title', description='$description', department='$department' WHERE id=$id";
    if (mysqli_query($conn, $update_query)) {
        header("Location: designation_management.php");
        exit();
    } else {
        $error = "Error updating designation: " . mysqli_error($conn);
    }
} else {
    $query = "SELECT * FROM designations WHERE id=$id LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $description = $row['description'];
        $department = $row['department'];
    } else {
        header("Location: designation_management.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Designation</title>
    <link rel="stylesheet" href="../css/edituser.css" />
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400..800&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
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
            <li><i class="fas fa-home"></i> <a>Dashboard</a></li>
            <li><i class="fas"></i> <a>User Management</a></li>
            <li><i class="fas"></i> <a>Role Assignment</a></li>
            <li><i class="fas"></i> <a>Department<br />Management</a></li>
            <li><i class="fas fa-briefcase"></i> <a>Designation<br />Management<br /></a></li>
        </ul>
        <div class="logout">
            <i class="fasfa-user-circle">@Admin</i>
            <a href="logout.php" class="logout-btn">Logout</a>
            <img src="../images/7853741_logout_kashifarif_exit_out_close_icon.png" class="loglogo" />
        </div>
    </aside>

    <!-- Main Content -->
    <main class="content">
    <header>
        <div class="header"></div> 
        <div class="boxnisiya">
        <img src="https://th.bing.com/th/id/OIP.0r_Yptp1denh0qR_YHt-LAHaHa?rs=1&pid=ImgDetMain" class="close-btn" role="button" onclick="window.location.href='designation_management.php'" />
            <h1>Edit Designation</h1>
            <h3 class="Mcreate">Edit job designation to the organization</h3>
            <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
            <form method="POST" action="edit_designation.php?id=<?php echo $id; ?>">
                <div class="form-group">
                     <label for="title">Title:</label>
                     <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required />
                </div>
                <div class="form-group">
                    <label for="department">Department:</label>
                    <select id="department" name="department" required>
                        <?php
                        $dept_result = mysqli_query($conn, "SELECT id, name FROM departments");
                        while ($dept = mysqli_fetch_assoc($dept_result)) {
                            $selected = ($dept['id'] == $department) ? "selected" : "";
                            echo "<option value='{$dept['id']}' $selected>{$dept['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($description); ?>" required />
                </div>
                <button type="submit">Save changes</button>
            </form>
        </div>
    </header>
</main>
</body>
</html>
