<?php
include('../connection.php');

if (!isset($_GET['id'])) {
    header("Location: designation_management.php");
    exit();
}

$id = intval($_GET['id']);

$delete_query = "DELETE FROM designations WHERE id=$id";
if (mysqli_query($conn, $delete_query)) {
    header("Location: designation_management.php");
    exit();
} else {
    echo "Error deleting designation: " . mysqli_error($conn);
}
?>
