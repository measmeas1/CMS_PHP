<?php 
  include '../../DB/db.php';
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM posts WHERE p_id='$id'";
    if(mysqli_query($con, $query)){
    header("Location: ". $_SERVER['HTTP_REFERER']);
    exit(); // Redirect back to user list
    } else {
      echo "Error: ". $_SERVER['HTTP_REFERER'];
    }
  }
?>