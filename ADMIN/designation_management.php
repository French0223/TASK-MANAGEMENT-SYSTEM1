<?php
// Include your database connection
include('../connection.php');

// Fetch existing designations with employee count and department names
$query = "SELECT d.*, dept.name AS department_name, COUNT(u.id) AS employee_count
          FROM designations d
          LEFT JOIN departments dept ON d.department = dept.id
          LEFT JOIN users u ON d.id = u.designation_id
          GROUP BY d.id";
$result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_designation'])) {
        $id = $_POST['edit_id'];
        $title = $_POST['edit_title'];
        $department = $_POST['edit_department'];
        $description = $_POST['edit_description'];

        $update_query = "UPDATE designations SET title='$title', department='$department', description='$description' WHERE id=$id";
        if (mysqli_query($conn, $update_query)) {
            header("Location: designation_management.php");  // Refresh the page to show updated list
            exit();
        } else {
            echo "Error updating designation: " . mysqli_error($conn);
        }
    } else {
        $title = $_POST['title'];
        $department = $_POST['department'];
        $description = $_POST['description'];

        $insert_query = "INSERT INTO designations (title, department, description) 
                         VALUES ('$title', '$department', '$description')";
        if (mysqli_query($conn, $insert_query)) {
            echo "New designation created successfully!";
            header("Location: designation_management.php");  // Refresh the page to show updated list
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designation Management</title>
    <link rel="stylesheet" type="text/css" href="../css/department_mng.css">
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

        <!-- Designation List Section -->
        <section class="user-list">
            <h2>Designation Management</h2>
            <div class="bastaword-wrapper">
                <h3 class="bastaword">Create and manage job designations in your organization</h3>
                    </div>
                </div>
            <div class="search-bar">
                <input id="designationSearch" class="ins" type="text" placeholder="Search designations...">
                <div class="adduser" role="button" onclick="window.location.href='add_designation.php'">
                <img src="../images/1814113_add_more_plus_icon.png" class="addb">
                <p class="useradd">Add designation</p>
                </div>
            </div>

            <table border="0">
                <tr>
                    <th>Title</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Employees</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr data-id='{$row['id']}'>
                        <td data-label='Title'>{$row['title']}</td>
                        <td data-label='Department'>{$row['department_name']}</td>
                        <td data-label='Description'>{$row['description']}</td>
                        <td data-label='Employees'>{$row['employee_count']}</td>
                        <td data-label='Created At'>{$row['created_at']}</td>
                        <td data-label='Actions'>
                            <div class='action-buttons'>
<a href='edit_designation.php?id={$row['id']}'>Edit</a> 
                                <a href='delete_designation.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </div>
                        </td>
                            </tr>";
                }
                ?>
            </table>
        </section>
    </main>

<?php mysqli_close($conn); ?>
<script>
document.getElementById('designationSearch').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('table tr:not(:first-child)');
    rows.forEach(row => {
        const title = row.querySelector('td[data-label="Title"]').textContent.toLowerCase();
        const department = row.querySelector('td[data-label="Department"]').textContent.toLowerCase();
        const description = row.querySelector('td[data-label="Description"]').textContent.toLowerCase();
        if (title.includes(filter) || department.includes(filter) || description.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
<!-- Edit Designation Modal -->
<div id="editModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
    <div class="modal-content" style="background:#fff; margin:10% auto; padding:20px; border-radius:8px; width:400px; position:relative;">
        <span id="closeModal" style="position:absolute; top:10px; right:15px; font-size:24px; cursor:pointer;">&times;</span>
        <h2>Edit Designation</h2>
        <form id="editForm" method="POST" action="designation_management.php">
            <input type="hidden" name="edit_id" id="edit_id">
            <div class="form-group">
                <label for="edit_title">Title:</label>
                <input type="text" id="edit_title" name="edit_title" required>
            </div>
            <div class="form-group">
                <label for="edit_department">Department:</label>
                <select id="edit_department" name="edit_department" required>
                    <?php
                    $dept_result = mysqli_query($conn, "SELECT id, name FROM departments");
                    while ($dept = mysqli_fetch_assoc($dept_result)) {
                        echo "<option value='{$dept['id']}'>{$dept['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="edit_description">Description:</label>
                <input type="text" id="edit_description" name="edit_description" required>
            </div>
            <button type="submit" name="update_designation">Save changes</button>
        </form>
    </div>
</div>

<script>
document.getElementById('designationSearch').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('table tr:not(:first-child)');
    rows.forEach(row => {
        const title = row.querySelector('td[data-label="Title"]').textContent.toLowerCase();
        const department = row.querySelector('td[data-label="Department"]').textContent.toLowerCase();
        const description = row.querySelector('td[data-label="Description"]').textContent.toLowerCase();
        if (title.includes(filter) || department.includes(filter) || description.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Modal functionality
const modal = document.getElementById('editModal');
const closeModal = document.getElementById('closeModal');
const editForm = document.getElementById('editForm');

document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.getAttribute('data-id');
        const title = this.getAttribute('data-title');
        const department = this.getAttribute('data-department');
        const description = this.getAttribute('data-description');

        document.getElementById('edit_id').value = id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_department').value = department;
        document.getElementById('edit_description').value = description;

        modal.style.display = 'block';
    });
});

closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});
</script>
</body>
</html>
