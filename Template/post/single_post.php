<?php
include '../../DB/db.php';
if (!isset($_GET['p_id'])) {
  header("Location: ../user/dashboard/index.php");
  exit();
}

$p_id = $_GET['p_id'];
$query = "SELECT posts.*, user.name FROM posts JOIN user ON posts.user_id = user.id WHERE posts.p_id = $p_id";
$result = mysqli_query($con, $query);

if (!$row = mysqli_fetch_assoc($result)) {
  // Instead of redirecting to home, we will show a modal or message in the same page
  $postNotFound = true;
} else {
  $postNotFound = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $row['title']; ?> | Post Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      color: #333;
    }

    .dark-mode {
      background-color: #1e1e2e;
      color: white;
    }

    .container {
      max-width: 800px;
    }

    .post-image {
      width: 100%;
      height: 400px;
      object-fit: contain;
      border-radius: 10px;
    }

    .card {
      border: none;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
      padding: 20px;
      background: white;
      border-radius: 15px;
    }

    .card.dark-mode {
      background: #282c34;
      color: white;
    }

    .back-btn {
      margin-bottom: 20px;
    }

    .text-muted {
      color: #6c757d !important;
    }

    .dark-mode .text-muted {
      color: #b0b3b8 !important;
      /* Light gray color for dark mode */
    }
  </style>
</head>

<body>

  <div class="container mt-5">
    <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="btn btn-outline-secondary back-btn">
      <i class="fa fa-arrow-left"></i> Back to Home
    </a>

    <?php if ($postNotFound): ?>
      <div class="alert alert-danger text-center" role="alert">
        The post you are looking for has been deleted or does not exist.
      </div>
    <?php else: ?>
      <div class="card">
        <h1 class="text-center mb-3"><?php echo $row['title']; ?></h1>
        <p class="text-muted text-center">
          Published by <b><?php echo $row['name']; ?></b> on <?php echo date("F d, Y", strtotime($row['p_date'])); ?>
        </p>
        <img src="../../img/post_img/<?php echo $row['p_picture']; ?>" class="post-image mt-3" alt="Post Image">

        <h4 class="mt-4">Description:</h4>
        <p><?php echo $row['description']; ?></p>

        <h4 class="mt-4">Content:</h4>
        <p><?php echo nl2br($row['content']); ?></p>
      </div>
    <?php endif; ?>
  </div>

  <script>
    if (localStorage.getItem("darkMode") === "enabled") {
      document.body.classList.add("dark-mode");
      document.querySelector(".card").classList.add("dark-mode");
    }
  </script>

</body>

</html>