<?php
include '../../DB/db.php';
$id = $_SESSION['id'];
$query = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$name = $row['name'] ?? 'Guest';
$picture = $row['picture'] ?? 'logo_1.jpg';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Your Post</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="../user/dashboard/css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    .img-fluid {
      object-fit: cover;
    }

    body {
      background-color: #121212;
      color: #ffffff;
    }

    .sb-sidenav .nav-link {
      color: #ffffff;
    }

    .card {
      background-color: #1e1e1e;
      color: #ffffff;

    }

    #datatablesSimple {
      color: white;

    }

    #datatablesSimple th,
    #datatablesSimple td {
      color: white !important;
    }

    #datatablesSimple thead {
      background-color: #333;
    }
    .no-posts-message {
    color: red !important;
    font-size: 30px;
    font-weight: bold;
  }
  
  </style>
</head>

<body class="sb-nav-fixed">
  <nav class="navbar navbar-dark navbar-expand bg-dark sb-topnav">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="post_table.php">Your Post Table</a>
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
          <li><a class="dropdown-item" href="../user/user_profile.php">Profile</a></li>
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
            <div class="sb-sidenav-menu-heading">Interface</div>
            <a class="collapsed nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon"><i class="fa-columns fas"></i></div>
              Layouts
              <div class="sb-sidenav-collapse-arrow"><i class="fa-angle-down fas"></i></div>
            </a>
            <a class="collapsed nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="fa-book-open fas"></i></div>
              Pages
              <div class="sb-sidenav-collapse-arrow"><i class="fa-angle-down fas"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
              <nav class="nav accordion sb-sidenav-menu-nested" id="sidenavAccordionPages">
                <a class="collapsed nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                  Authentication
                  <div class="sb-sidenav-collapse-arrow"><i class="fa-angle-down fas"></i></div>
                </a>
                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                  <nav class="nav sb-sidenav-menu-nested">
                    <a class="nav-link" href="../user/login.php">Login</a>
                    <a class="nav-link" href="../user/register.php">Register</a>
                  </nav>
                </div>
              </nav>
            </div>
            <div class="sb-sidenav-menu-heading">Tables</div>
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
            <a class="nav-link" href="create_post.php">
              <div class="sb-nav-link-icon"><i class="fa-edit fas"></i></div>
              Create Post
            </a>
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          <?php echo $name ?>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Your Post</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="../user/dashboard/index.php">Dashboard</a></li>
            <li class="active breadcrumb-item">Tables</li>
          </ol>
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-content-center">
              <p class="m-0 mt-2"><i class="fa-table fas me-1"></i>DataTable Example</p>
              <a href="create_post.php" class="rounded-2 btn btn-primary">Create Post</a>
            </div>
            <div class="card-body">
              <table id="datatablesSimple">
                <?php if (mysqli_num_rows($result) > 0) { ?>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Content</th>
                      <th>Date</th>
                      <th>Picture</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Content</th>
                      <th>Date</th>
                      <th>Picture</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    // Fetch data from database
                    $id = $_SESSION['id'];
                    $query = "SELECT * from posts WHERE user_id = $id";
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                      $id = $row['p_id'];
                      $title = $row['title'];
                      $description = $row['description'];
                      $content = $row['content'];
                      $date = $row['p_date'];
                      $picture = $row['p_picture'];
                      $p_id = $row['user_id'];
                      $user = "SELECT * FROM user WHERE id = $p_id";
                      $user_result = mysqli_query($con, $user);
                      $user_row = mysqli_fetch_assoc($user_result);
                    ?>
                      <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $title ?></td>
                        <td><?php echo substr($description, 0, 90,) ?></td>
                        <td><?php echo substr($content, 0, 20) ?></td>
                        <td><?php echo $date ?></td>
                        <td>
                          <img src="../../img/post_img/<?php echo $picture ?>" alt="<?php echo $name ?>" class="rounded-circle img-fluid" style="width: 50px; height: 50px;">
                        </td>
                        <td>
                          <div class="d-flex my-2">
                            <a href="single_post.php?p_id=<?php echo $id ?> " class="btn btn-action btn-warning btn-sm ms-1">
                              <i class="fa-eye fas"></i>
                            </a>
                            <a href="user_delete_post.php?id=<?php echo $id; ?>" class="btn btn-action btn-danger btn-sm ms-1" onclick="return confirm('Are you sure?');">
                              <i class="fa-trash fas"></i>
                            </a>
                            <a href="edit_post.php?p_id=<?php echo $id ?>" class="btn btn-action btn-secondary btn-sm ms-1">
                              <i class="fas fa-edit"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                <?php } else { ?>
                  <tr>
                    <td colspan="7" class="text-center no-posts-message" style="color: red; font-size: 30px; font-weight: bold;">
                      No posts available!
                    </td>
                  </tr>
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </main>
      <footer class="bg-dark mt-auto py-4">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; CMS Manage 2025</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../user/dashboard/js/scripts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script src="../user/dashboard/js/datatables-simple-demo.js"></script>
</body>

</html>