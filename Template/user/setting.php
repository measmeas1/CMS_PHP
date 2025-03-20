<?php
include '../../DB/db.php';
$success = false;
$error = "";

// Fetch user data (Assuming user ID is stored in session)
session_start();
$id = $_SESSION['id'];
$query = "SELECT * FROM user WHERE id='$id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $date_of_birth = $_POST['date_of_birth'];
  $country = $_POST['country'];
  $city = $_POST['city'];
  $website = $_POST['website'];
  $bio = $_POST['bio'];

  // Handle profile picture update
  if (!empty($_FILES['picture']['name'])) {
    $picture = $_FILES['picture']['name'];
    $tmp_picture = $_FILES['picture']['tmp_name'];
    move_uploaded_file($tmp_picture, "../img/$picture");
  } else {
    $picture = $user['picture']; // Keep existing picture
  }

  $update_query = "UPDATE user SET name='$name', gender='$gender', picture='$picture', 
                    date_of_birth='$date_of_birth', country='$country', city='$city', 
                    website='$website', bio='$bio' WHERE id='$id'";

  if (mysqli_query($con, $update_query)) {
    // Redirect to home page after successful update
    header("Location: home.php"); 
    exit(); // Always call exit after header to stop further execution
  } else {
    $error = "Error: " . mysqli_error($con);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../asset/register.css">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <h4>Update Profile</h4>
          </div>
          <div class="card-body">
            <form action="setting.php" method="POST" enctype="multipart/form-data">

              <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-control">
                  <option value="Male" <?php if ($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                  <option value="Female" <?php if ($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Profile Picture</label>
                <input type="file" name="picture" class="form-control">
                <?php if ($user['picture']) {
                  echo "<img src='../img/" . $user['picture'] . "' width='100' class='mt-2'>";
                } ?>
              </div>

              <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control" value="<?php echo $user['date_of_birth']; ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Country</label>
                <input type="text" name="country" class="form-control" value="<?php echo $user['country']; ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control" value="<?php echo $user['city']; ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Website</label>
                <input type="url" name="website" class="form-control" value="<?php echo $user['website']; ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control" rows="3"><?php echo $user['bio']; ?></textarea>
              </div>

              <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            </form>
            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-danger w-100 mt-3">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if ($error): ?>
    <div class="alert alert-danger text-center mt-3"><?php echo $error; ?></div>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
