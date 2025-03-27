<?php
include '../../DB/db.php';

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    die("Access denied!");
}

$id = $_SESSION['id']; // Logged-in user ID

// Get user role from the database
$query = "SELECT is_admin FROM user WHERE id='$id'";
$result = mysqli_query($con, $query);
$log_user = mysqli_fetch_assoc($result);

// Check if the logged-in user is an admin
if ($log_user['is_admin'] != 1) {
    die("Access denied! You are not an admin.");
}

// Check if an ID is provided in the request
if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];

    // Prevent self-deletion
    if ($delete_id == $id) {
        die("You cannot delete yourself!");
    }

    // Check if the target user exists and get their role
    $target_query = "SELECT is_admin FROM user WHERE id='$delete_id'";
    $target_result = mysqli_query($con, $target_query);
    $target_user = mysqli_fetch_assoc($target_result);

    if (!$target_user) {
        die("User does not exist!");
    }

    // Ensure that admins cannot delete other admins
    if ($target_user['is_admin'] == 1) {
        die("You cannot delete another admin!");
    }

    // Execute delete query for non-admin users
    $delete_query = "DELETE FROM user WHERE id='$delete_id'";
    if (mysqli_query($con, $delete_query)) {
        header("Location: dashboard/tables.php"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Invalid request!";
}
?>
