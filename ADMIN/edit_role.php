<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "database1"); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$selected_user = null;
$selected_role = null;
$message = "";

// Handle POST request to update role
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['role'])) {
    $user_id = intval($_POST['user_id']);
    $new_role = $conn->real_escape_string($_POST['role']);
    $update_sql = "UPDATE users SET role = '$new_role' WHERE id = $user_id";
    if ($conn->query($update_sql) === TRUE) {
        $message = "Role updated successfully.";
        // Redirect to avoid form resubmission
        header("Location: edit_role.php?user_id=$user_id&updated=1&success=1");
        exit();
    } else {
        $message = "Error updating role: " . $conn->error;
    }
}

// Handle GET request to load selected user
if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $user_sql = "SELECT id, username, role FROM users WHERE id = $user_id LIMIT 1";
    $user_result = $conn->query($user_sql);
    if ($user_result && $user_result->num_rows > 0) {
        $selected_user = $user_result->fetch_assoc();
        $selected_role = $selected_user['role'];
    }
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
    <link rel="stylesheet" href="../css/edit_role.css">
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
            <img src="../images/211694_bell_icon.png" class="bell" role="button" onclick="alert('Button clicked!')">
            <img src="../images/8678233_message_communication_chat_icon.png" class="message" role="button" onclick="alert('Button clicked!')">
        </div>
    </header>
    <div class="box">
    <p class="word">Role Assignment</p>
    <p class="word1">Assigned Roles and Permission to users in the system.</p>
    <p class="word2">Select user</p>

    <img src="../images/3643745_human_man_people_person_profile_icon.png" class="human">

    <div class="minib">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="box1" role="button" onclick="window.location.href='edit_role.php?user_id=<?= $row['id'] ?>'" style="cursor:pointer;">
                <div class="top-row">
                    <p class="U"><?= htmlspecialchars($row['username']) ?></p>
                    <div class="supervisor">
                        <img src="../images/9036002_shield_sharp_icon.png" class="superb">
                        <p class="S"><?= htmlspecialchars($row['role_name']) ?></p>
                    </div>
                </div>
                    <p class="G"><?= htmlspecialchars($row['email']) ?></p>
                     <p class="Eg"><?= htmlspecialchars($row['department_name']) ?></p>
                </div>
        <?php endwhile; ?>
    </div>    

    <?php if ($selected_user): ?>
    <form method="POST" action="edit_role.php" class="role-form">
        <h3>Editing Role for: <?= htmlspecialchars($selected_user['username']) ?></h3>
        <input type="hidden" name="user_id" value="<?= $selected_user['id'] ?>">
        <div class="choices">
            <?php
            $roles = ['Admin', 'Supervisor', 'Manager', 'Employee'];
            foreach ($roles as $role) {
                $active_class = ($role === $selected_role) ? 'selected-role' : '';
                echo "<button type='button' class='Save $active_class' onclick=\"selectRole(this, '$role')\">$role</button>";
            }
            ?>
        </div>
        <input type="hidden" name="role" id="role_input" value="<?= htmlspecialchars($selected_role) ?>">
        <div class="button-container">
<button type="button" class="cancel" onclick="window.location.href='role_assignment2.php'">Return</button>
            <button type="submit" class="Save">Save</button>
        </div>
    </form>
    <?php endif; ?>
</div>
<script>
function selectRole(button, role) {
    // Remove selected-role class from all role buttons
    const buttons = document.querySelectorAll('.choices button');
    buttons.forEach(btn => btn.classList.remove('selected-role'));
    // Add selected-role class to clicked button
    button.classList.add('selected-role');
    // Set hidden input value
    document.getElementById('role_input').value = role;
}
</script>
</main>
<script>
function filterUsers() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const boxes = document.querySelectorAll('.minib .box1');
    boxes.forEach(box => {
        const username = box.querySelector('.U').textContent.toLowerCase();
        if (username.includes(filter)) {
            box.style.display = '';
        } else {
            box.style.display = 'none';
        }
    });
}
</script>
<style>
/* Highlight selected role button */
.selected-role {
    background-color: #4CAF50 !important;
    color: white !important;
}
</style>
</body>
</html>
<?php
$conn->close();
?>
<link rel="stylesheet" href="../css/Role_Assignment2.css">
