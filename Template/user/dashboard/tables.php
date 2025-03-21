<?php
session_start();
include '../../../DB/db.php';
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
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
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
        <a class="navbar-brand ps-3" href="index.php">Tables</a>
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
                    <img src="../../../img/<?php echo htmlspecialchars($picture) ?>" alt="Profile" class="rounded-circle" width="40" height="40">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../setting.php">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
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
                        <a class="nav-link" href="../home.php">
                            <div class="sb-nav-link-icon"><i class="fa-bars fas"></i></div>
                            Home
                        </a>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fa-tachometer-alt fas"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="collapsed nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-columns fas"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fa-angle-down fas"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="nav sb-sidenav-menu-nested">
                                <a class="nav-link" href="layout-static.php">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.php">Light Sidenav</a>
                            </nav>
                        </div>
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
                                        <a class="nav-link" href="../login.php">Login</a>
                                        <a class="nav-link" href="../register.php">Register</a>
                                        <a class="nav-link" href="#">Forgot Password</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.php">
                            <div class="sb-nav-link-icon"><i class="fa-chart-area fas"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fa-table fas"></i></div>
                            Tables
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
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="active breadcrumb-item">Tables</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-table fas me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Date of Birth</th>
                                        <th>Website</th>
                                        <th>Bio</th>
                                        <th>Picture</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Date of Birth</th>
                                        <th>Website</th>
                                        <th>Bio</th>
                                        <th>Picture</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <?php
                                        // Fetch data from database
                                        $result = mysqli_query($con, "SELECT * FROM user");

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            $email = $row['email'];
                                            $gender = $row['gender'];
                                            $country = $row['country'];
                                            $city = $row['city'];
                                            $dob = $row['date_of_birth'];
                                            $website = $row['website'];
                                            $bio = $row['bio'];
                                            $picture = $row['picture'];
                                        ?>
                                            <td><?php echo $id ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $email ?></td>
                                            <td><?php echo $gender ?></td>
                                            <td><?php echo $country ?></td>
                                            <td><?php echo $city ?></td>
                                            <td><?php echo $dob ?></td>
                                            <td><?php echo $website ?></td>
                                            <td><?php echo $bio ?></td>
                                            <td>
                                                <img src="../../../img/<?php echo $picture ?>" alt="<?php echo $name ?>" class="rounded-circle img-fluid" style="width: 50px; height: 50px;">
                                            </td>
                                            <td>
                                                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 && $row['is_admin'] == 0) { ?>
                                                <a href="../make_admin.php?id=<?php echo $id; ?>" class="btn btn-action btn-sm btn-warning">
                                                    <i class="fa-edit fas"></i>
                                                </a>
                                                <?php } ?>
                                                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 && $row['is_admin'] == 0) { ?>
                                                    <a href="../delete.php?id=<?php echo $id; ?>" class="btn btn-action btn-danger btn-sm" onclick="return confirm('Are you sure?');">
                                                        <i class="fa-trash fas"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="bg-light mt-auto py-4">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
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
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>