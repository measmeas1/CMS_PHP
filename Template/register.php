<?php 
include '../DB/db.php';
$success = false;
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $website = $_POST['website'];
    $bio = $_POST['bio'];

    $picture = $_FILES['picture']['name'];
    $tmp_picture = $_FILES['picture']['tmp_name'];
    move_uploaded_file($tmp_picture, "../img/$picture");

    // Check if passwords match
    if ($password !== $c_password) {
        $error = "Passwords do not match!";
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO user (name, email, password, gender, picture, date_of_birth, country, city, website, bio) 
                  VALUES ('$name', '$email', '$password_hash', '$gender', '$picture', '$date_of_birth', '$country', '$city', '$website', '$bio')";

        if (mysqli_query($con, $query)) {
            $success = true;
        } else {
            $error = "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../asset/register.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>User Registration</h4>
                    </div>
                    <div class="card-body">
                        <form action="register.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                            
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" name="picture" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Website</label>
                                <input type="url" name="website" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bio</label>
                                <textarea name="bio" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="is_admin" value="1">
                                <label class="form-check-label">Is Admin</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Register</button>
                            <p class="mt-2 text-center text-white">Already have an account? <a href="login.php">Login here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  <?php if ($success): ?>
      <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header bg-success text-white">
                      <h5 class="modal-title" id="successModalLabel">Success</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      User registered successfully!
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="redirectBtn">Go to Login</button>
                  </div>
              </div>
          </div>
      </div>
      <script>
          document.addEventListener("DOMContentLoaded", function () {
              var successModal = new bootstrap.Modal(document.getElementById("successModal"));
              successModal.show();
  
              // Redirect after modal is closed
              document.getElementById("redirectBtn").addEventListener("click", function () {
                  window.location.href = "login.php";
              });
          });
      </script>
  <?php endif; ?>
  
  <script>
      function validateForm() {
          var password = document.querySelector('[name="password"]').value;
          var confirmPassword = document.querySelector('[name="confirm_password"]').value;
  
          if (password !== confirmPassword) {
              alert("Passwords do not match! Please try again.");
              return false; // Prevent form submission
          }
          return true;
      }
  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
