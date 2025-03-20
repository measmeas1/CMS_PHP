<?php 
  session_start();
  include '../../DB/db.php';
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if both email and password are filled
    if (empty($email) || empty($password)) {
      echo "<script> 
              document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.error-message-empty').classList.add('show');
              });
            </script>";
    } else {
      // Query to check for the email
      $query = "SELECT * FROM user WHERE email='$email'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_assoc($result);

      // Check if user exists
      if ($row) {
        $verify = $row['password'];
        $id = $row['id'];

        // Verify password
        if (password_verify($password, $verify)) {
          $_SESSION['id'] = $id;
          $_SESSION['is_admin'] = $row['is_admin'];
          echo "<script>window.open('home.php', '_self');</script>";
        } else {
          echo "<script>
                  document.addEventListener('DOMContentLoaded', function() {
                    document.querySelector('.error-message-password').classList.add('show');
                  });
                </script>";
        }
      } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                  document.querySelector('.error-message-email').classList.add('show');
                });
              </script>";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../asset/login.css">
  <title>Login</title>
</head>
<body>

<div class="ring">
    <i style="--clr:#00ff0a;"></i>
    <i style="--clr:#ff0057;"></i>
    <i style="--clr:#1766cc;"></i>
    <div class="login">
      <h2>Login</h2>
      <form method="post">
        <div class="inputBx">
          <input type="text" name="email" placeholder="Email" class="form-control">
        </div>
        <div class="inputBx">
          <input type="password" name="password" placeholder="Password" class="form-control">
          <!-- Add these error messages inside your HTML -->
          <div class="error-message error-message-empty">Please fill in both field!</div>
          <div class="error-message error-message-email">Email not found!</div>
          <div class="error-message error-message-password">Incorrect password!</div>
        </div>
        <div class="inputBx">
          <button type="submit">Sign In</button>
        </div>
      </form>
      <div class="links">
        <a href="#">Forget Password</a>
        <a href="register.php">Signup</a>
      </div>
    </div>
  </div>
</body>
</html>