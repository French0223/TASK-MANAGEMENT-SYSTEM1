<?php
include('../connection.php');

if (!isset($_GET['id'])) {
    header("Location: department_management.php");
    exit();
}

$id = intval($_GET['id']);

$delete_query = "DELETE FROM departments WHERE id=$id";
if (mysqli_query($conn, $delete_query)) {
    header("Location: department_management.php");
    exit();
} else {
    echo "Error deleting department: " . mysqli_error($conn);
}
?>
