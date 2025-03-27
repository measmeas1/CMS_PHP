<?php 
  session_start(); 
  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'cms_php';
  $port = 3307;

  $con = mysqli_connect($server, $user, $pass, $db, $port);
  
  if (!$con){
    die("Connection failed: ". mysqli_connect_error());
  }
?> 