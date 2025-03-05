<?php
include("connection.php");
session_start();

if(isset($_POST['submit'])) { 
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $role = $_POST['role']; // Get selected role from the form

    // Debugging: Print entered values
    echo "Entered Username: " . $username . "<br>";
    echo "Entered Password: " . $password . "<br>";
    echo "Entered Role: " . $role . "<br>";

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT username, password, role FROM login WHERE username = ? AND password = ? AND role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Debugging: Print fetched values from the database
        echo "Database Username: " . $row['username'] . "<br>";
        echo "Database Password: " . $row['password'] . "<br>";
        echo "Database Role: " . $row['role'] . "<br>";

        // Ensure the role matches what was entered
        if ($row['role'] === $role) {
            $_SESSION['username'] = $row['username']; 
            $_SESSION['role'] = $row['role'];

            // Redirect based on role
            if ($row['role'] == 'admin') {
                echo "Redirecting to Admin Dashboard...";
                header("Location: admin_dashboard.php");
            } elseif ($row['role'] == 'supervisor') {
                echo "Redirecting to Supervisor Dashboard...";
                header("Location: supervisor_dashboard.php");
            } elseif ($row['role'] == 'manager') {
                echo "Redirecting to Manager Dashboard...";
                header("Location: manager_dashboard.php");
            } else {
                echo "Redirecting to Employee Dashboard...";
                header("Location: employee_dashboard.php");
            }
            exit();
        } else {
            echo '<script>
                    alert("Login failed. The role does not match the assigned role!!!");
                    window.location.href = "index.php";
                  </script>';
        }
    } else {
        echo '<script>
                alert("Login failed. Invalid username or password!!!");
                window.location.href = "index.php";
              </script>';
    }
}
?>
