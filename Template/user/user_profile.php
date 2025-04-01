<?php
include '../../DB/db.php';

  $id = $_SESSION['id'];
  $query = "SELECT * FROM user WHERE id = '$id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  $name = $row['name'] ?? 'Guest';
  $picture = $row['picture'] ?? 'logo_1.jpg';
  $email = $row['email'];
  $country = $row['country'];
  $city = $row['city'];
  $dob = $row['date_of_birth'];
  $website = $row['website'];
  $bio = $row['bio'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link rel="stylesheet" href="./dashboard/css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      background-color: #f4f7fc;
    }

    .profile-container {
      max-width: 1400px;
      padding: 40px;
      background: #f8f9fa;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      margin: 20px;
    }

    .profile-img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #ddd;
      transition: all 0.3s ease;
    }

    .profile-img:hover {
      transform: scale(1.1);
      border-color: #007bff;
    }

    /* Bio box styling */
    .bio-box {
      background: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      height: 250px;
    }
    

    /* Custom padding for the columns */
    .profile-column {
      padding: 50px;
    }

    /* Table for profile settings */
    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
      table-layout: fixed;
    }

    table th,
    table td {
      padding: 12px 15px;
      text-align: left;
      font-size: 1rem;
      word-wrap: break-word;
      white-space: nowrap; /* Ensures text doesn't wrap */
      overflow: hidden;
      text-overflow: ellipsis;
    }

    table th {
      background-color: #f1f1f1;
      color: #555;
      font-weight: 500;
    }

    table td {
      background-color: #fafafa;
    }

    table td a {
      color: #007bff;
      text-decoration: none;
    }

    table td a:hover {
      text-decoration: underline;
    }


    /* @media (max-width: 768px) {
      .profile-container {
        padding: 15px;
      }
      .profile-column {
        padding: 10px;
      }
    } */
  </style>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="./dashboard/index.php">CMS Dashboard</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-lg order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
      </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../../img/<?php echo htmlspecialchars($picture) ?>" alt="Profile" class="rounded-circle" width="40" height="40">
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="user_profile.php">Profile</a></li>
          <li><a class="dropdown-item" href="setting.php">Settings</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="../../index.php">
              <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
              Home
            </a>
            <a class="nav-link" href="./dashboard/index.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
              Layouts
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="./layout-static.php">Static Navigation</a>
                <a class="nav-link" href="./layout-sidenav-light.php">Light Sidenav</a>
              </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
              Pages
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                  Authentication
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="login.php">Login</a>
                    <a class="nav-link" href="register.php">Register</a>
                  </nav>
                </div>

              </nav>
            </div>
            <div class="sb-sidenav-menu-heading">Addons</div>
            <a class="nav-link" href="dashboard/charts.php">
              <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
              Charts
            </a>
            <a class="nav-link" href="dashboard/tables.php">
              <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
              User
            </a>
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          <div><?php echo $name ?></div>
        </div>
      </nav>
    </div>
    <div class="container mt-5">
      <div class="profile-container">
        <div class="row">
          <!-- Column 1: Name & Email -->
          <div class="col-md-4 profile-column text-center">
            <img src="../../img/<?php echo htmlspecialchars($picture); ?>" alt="Profile Picture" class="profile-img">
            <h4 class="mt-2"><?php echo htmlspecialchars($name); ?></h4>
            <p><?php echo htmlspecialchars($email); ?></p>
          </div>

          <!-- Column 2: Profile Settings -->
          <div class="col-md-4 profile-column">
            <h4>Profile Settings</h4>
            <table>
              <tr>
                <th>Country:</th>
                <td><?php echo htmlspecialchars($country); ?></td>
              </tr>
              <tr>
                <th>City:</th>
                <td><?php echo htmlspecialchars($city); ?></td>
              </tr>
              <tr>
                <th>Date of Birth:</th>
                <td><?php echo htmlspecialchars($dob); ?></td>
              </tr>
              <tr>
                <th>Website:</th>
                <td><a href="<?php echo htmlspecialchars($website); ?>" target="_blank"><?php echo htmlspecialchars($website); ?></a></td>
              </tr>
            </table>
          </div>

          <!-- Column 3: Bio -->
          <div class="col-md-4 profile-column">
            <h4>Bio</h4>
            <div class="bio-box">
              <p><?php echo htmlspecialchars($bio); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="./dashboard/js/scripts.js"></script>
</body>

</html>