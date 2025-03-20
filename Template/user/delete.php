<?php 
session_start();
include '../../DB/db.php';
if(isset($_GET['id'])){
  $id = $_GET['id'];

  $query = "DELETE FROM user WHERE id='$id'";
  if(mysqli_query($con, $query)){
    echo "<script>Customer have been deleted.</script>";
    echo "<script>window.open('dashboard/tables.php', '_self')</script>";
  }
}
?>