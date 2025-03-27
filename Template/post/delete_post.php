<?php
include '../../DB/db.php';

if (!isset($_SESSION['id'])) {
  die("Access denied");
}

$id = $_SESSION['id'];

$query = "SELECT is_admin FROM user WHERE id='$id'";
$result = mysqli_query($con, $query);
$log_user = mysqli_fetch_assoc($result);

if ($log_user['is_admin'] != 1) {
  die("Access denied! You are not an admin.");
}

if (isset($_GET['id'])) {
  $delete_id = $_GET['id'];
  $target_query = "SELECT is_admin FROM user WHERE id='$delete_id'";
  $target_result = mysqli_query($con, $target_query);
  $target_user = mysqli_fetch_assoc($target_result);

  $delete_query = "DELETE FROM posts WHERE p_id='$delete_id'";
  if (mysqli_query($con, $delete_query)) {
      header("Location: post_table.php"); // Redirect back to user list
      exit();
  } else {
      echo "Error: " . mysqli_error($con);
  }
} else {
  echo "Invalid request!";
}

?>