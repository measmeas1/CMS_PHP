<?php
include '../../DB/db.php';
$success = false;
$error = "";

if(isset($_GET['p_id'])){
  $id = $_GET['p_id'];
  $query = "SELECT * FROM posts WHERE p_id='$id'";
  $result = mysqli_query($con, $query);
  $post = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $content = $_POST['content'];
  $date = $_POST['p_date'];

  // Handle profile picture update
  if (!empty($_FILES['p_picture']['name'])) {
    $picture = $_FILES['p_picture']['name'];
    $tmp_picture = $_FILES['p_picture']['tmp_name'];
    move_uploaded_file($tmp_picture, "../../img/post_img/$picture");
  } else {
    $picture = $post['p_picture']; // Keep existing picture
  }

  $update_query = "UPDATE posts SET title='$title', description='$description', content='$content', p_picture='$picture', p_date='$date' WHERE p_id='$id'";

  if (mysqli_query($con, $update_query)) {
    header("Location: ../../index.php");
    exit(); 
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
  <title>Edit Post</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../asset/register.css">
  <style>
    .rounded-circle{
      object-fit: cover;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <h4>Update Post</h4>
          </div>
          <div class="card-body">
            <form action="edit_post.php?p_id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">

              <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="description" class="form-control" value="<?php echo $post['description']; ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Content</label>
                <input type="text" name="content" class="form-control" value="<?php echo $post['content']; ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" name="p_date" class="form-control" value="<?php echo $post['p_date']; ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">Profile Picture</label>
                <input type="file" name="p_picture" class="form-control">
                <?php if (!empty($post['p_picture'])): ?>
                  <img src="../../img/post_img/<?php echo $post['p_picture']; ?>" width="100" height="100" class="rounded-circle mt-2">
                <?php endif; ?>
              </div>

              <button type="submit" class="btn btn-primary w-100">Update Post</button>
            </form>
            <a href="<?php echo $_SERVER['HTTP_REFERER'] ?? '../user/home.php'; ?>" class="btn btn-danger w-100 mt-3">Cancel</a>
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
