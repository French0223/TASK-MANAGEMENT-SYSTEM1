<?php
include("connection.php");
session_start();

if (isset($_POST['submit'])) { 
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Query to check user credentials
    $sql = "SELECT id, username, password, role FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username']; 
        $_SESSION['role'] = $row['role'];

        // Redirect based on role
        switch ($row['role']) {
            case 'admin':
                header("Location: ADMIN/admin_dashboard.php");
                break;
            case 'supervisor':
                header("Location: SUPERVISOR/supervisor_dashboard.php");
                break;
            case 'manager':
                header("Location: MANAGER/manager_dashboard.php");
                break;
            case 'employee':
                header("Location: EMPLOYEE/employee_dashboard.php");
                break;
            default:
                echo '<script>
                        alert("Login failed. Role not recognized!");
                        window.location.href = "index.php";
                      </script>';
                exit();
        }
        exit();
    } else {
        echo '<script>
                alert("Login failed. Invalid username or password!");
                window.location.href = "index.php";
              </script>';
    }
}
?>
