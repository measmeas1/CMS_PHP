<?php
include '../../DB/db.php';

$id = $_SESSION['id'];
$query = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$name = $row['name'] ?? 'Guest';
$picture = $row['picture'] ?? 'logo_1.jpg';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $picture = $_FILES['p_picture']['name'];
    $picture_tmp = $_FILES['p_picture']['tmp_name'];
    $date = date('Y-m-d H:i:s');
    $p_date = $date;
    $id = $_SESSION['id'];
    move_uploaded_file($picture_tmp, "../../img/post_img/$picture");

    $query = "INSERT INTO posts (title, description, content, p_picture, p_date, user_id)
              VALUES ('$title', '$description', '$content', '$picture', '$date', '$id')";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Create Post Successful!')</script>";
        header("Location: ../../index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../user/dashboard/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .img-fluid {
            object-fit: cover;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="navbar navbar-dark navbar-expand bg-dark sb-topnav">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="../user/dashboard/index.php">Create Post</a>
        <!-- Sidebar Toggle-->
        <button class="order-1 order-lg-0 btn btn-link btn-sm me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fa-bars fas"></i></button>
        <!-- Navbar Search-->
        <form class="d-md-inline-block d-none form-inline me-0 me-md-3 ms-auto my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fa-search fas"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav me-3 me-lg-4 ms-auto ms-md-0">
            <li class="dropdown nav-item">
                <a class="dropdown-toggle nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../../img/<?php echo htmlspecialchars($picture) ?>" alt="Profile" class="rounded-circle" width="40" height="40">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../user/setting.php">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../user/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="accordion sb-sidenav sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="../../index.php">
                            <div class="sb-nav-link-icon"><i class="fa-bars fas"></i></div>
                            Home
                        </a>
                        <a class="nav-link" href="../user/dashboard/index.php">
                            <div class="sb-nav-link-icon"><i class="fa-tachometer-alt fas"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="../user/dashboard/tables.php">
                            <div class="sb-nav-link-icon"><i class="fa-users fas"></i></div>
                            Users
                        </a>
                        <a class="nav-link" href="post_table.php">
                            <div class="sb-nav-link-icon"><i class="fa-podcast fas"></i></div>
                            Posts
                        </a>
                        <a class="nav-link" href="user_post.php">
                            <div class="sb-nav-link-icon"><i class="fa-user-friends fas"></i></div>
                            Your Post
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $name ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content" class="bg-dark">
            <main>
                <form action="create_post.php" method="POST" enctype="multipart/form-data" class="p-4 rounded text-white">
                    <h2 class="text-center mb-4">Create a Post</h2>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control bg-secondary text-white" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control bg-secondary text-white" id="description" name="description" required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control bg-secondary text-white" id="content" name="content" rows="5" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="picture" class="form-label">Upload Picture</label>
                        <input type="file" class="form-control bg-secondary text-white" id="picture" name="p_picture">
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Publish Date</label>
                        <input type="date" class="form-control bg-secondary text-white" id="date" name="p_date" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit Post</button>
                    </div>
                </form>

            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../user/dashboard/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../user/dashboard/js/datatables-simple-demo.js"></script>
</body>

</html>