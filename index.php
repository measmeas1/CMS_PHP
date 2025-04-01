<?php
include 'DB/db.php';

$id = $_SESSION['id'];
$query = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$name = $row['name'] ?? 'Guest';
$picture = $row['picture'] ?? 'None';
$p_user = $_SESSION['user_id'] ?? 'Guest';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="Template/user/dashboard/css/styles.css">
    <style>
        .dark-mode {
            background-color: #1e1e2e;
            color: white;
        }

        .content {
            margin-left: 280px;
            padding: 30px;
            transition: margin-left 0.3s;
            padding-top: 40px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            background-color: white;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        .dark-mode .card {
            background-color: #2b2b3a !important;
            color: white;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.1);
        }

        .dark-mode .card:hover {
            box-shadow: 0px 3px 15px rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }

        .toggle-btn {
            position: fixed;
            top: 15px;
            right: 20px;
            cursor: pointer;
            color: white;
            transition: color 0.3s ease-in-out;
        }

        .dark-mode .toggle-btn {
            color: grey;
        }

        .rounded-circle {
            box-shadow: 0px 0px 8px rgba(255, 255, 255, 0.5);
            object-fit: cover;
        }

        .card-img-top {
            object-fit: cover;
        }

        #layoutSidenav_content {
            margin-top: 50px;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">CMS Home</a>
        <i class="fa-lg fa-moon fas mt-3 toggle-btn" id="darkModeToggle"></i>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="accordion sb-sidenav sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <?php if(isset($_SESSION['id'])) {?>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fa-bars fas"></i></div>
                            Home
                        </a>
                        <a class="nav-link" href="Template/user/dashboard/index.php">
                            <div class="sb-nav-link-icon"><i class="fa-tachometer-alt fas"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="Template/user/dashboard/tables.php">
                            <div class="sb-nav-link-icon"><i class="fa-users fas"></i></div>
                            Users
                        </a>
                        <a class="nav-link" href="Template/post/post_table.php">
                            <div class="sb-nav-link-icon"><i class="fa-podcast fas"></i></div>
                            Posts
                        </a>
                        <a class="nav-link" href="Template/post/user_post.php">
                            <div class="sb-nav-link-icon"><i class="fa-user-friends fas"></i></div>
                            Your Post
                        </a>
                        <a class="nav-link" href="Template/post/create_post.php">
                            <div class="sb-nav-link-icon"><i class="fa-edit fas"></i></div>
                            Create Posts
                        </a>
                        <a class="nav-link" href="Template/user/setting.php">
                            <div class="sb-nav-link-icon"><i class="fa-cog fas"></i></div>
                            Settings
                        </a>
                        <a class="nav-link" href="Template/user/logout.php" onclick="confirmLogout()">
                            <div class="sb-nav-link-icon"><i class="fa-sign-out-alt fas"></i></div>
                            Logout
                        </a>
                        <?php } else {?>      
                        <a class="nav-link" href="Template/user/login.php">
                            <div class="sb-nav-link-icon"><i class="fa-sign-in fas"></i></div>
                            Login
                        </a>
                        <a class="nav-link" href="Template/user/register.php">
                            <div class="sb-nav-link-icon"><i class="fa-registered fas"></i></div>
                            Register
                        </a>
                        <?php }?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $name ?>
                </div>
            </nav>
        </div>
    </div>

    <div class="content" id="layoutSidenav_content">
        <div class="d-flex align-items-center mb-3 main_contain">
            <img src="img/<?php echo $picture; ?>" class="rounded-circle me-3" width="50" height="50" alt="Profile Picture">
            <h2>Welcome, <?php echo $name; ?>!</h2>
        </div>
        <h2 align="center" class="m-4">Blog Posts</h2>

        <div class="row">
            <?php
            $query = "SELECT * FROM posts";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $p_id = $row['user_id'];
                $user = "SELECT * FROM user WHERE id = $p_id";
                $user_result = mysqli_query($con, $user);
                $user_row = mysqli_fetch_assoc($user_result);
            ?>
                <!-- Blog Post Card 1 -->
                <div class="col-md-3 mt-3">
                    <div class="card bg-body-secondary">
                        <img src="img/post_img/<?php echo $row['p_picture'] ?> " class="card-img-top" alt="Post Image" height="250px">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo substr($row['title'], 0, 30) ?></h5>
                            <p class="card-title"><?php echo substr($row['description'], 0, 41) ?></p>
                            <p class="text-secondary">Posted by: <?php echo $user_row['name'] ?? 'User Delete!' ?></p>
                            <a href="Template/post/single_post.php?p_id=<?php echo $row['p_id'] ?>" class="btn btn-primary btn-sm w-100">Read More</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = 'logout.php';
            }
        }

        document.getElementById("darkModeToggle").addEventListener("click", function() {
            document.body.classList.toggle("dark-mode");
            if (document.body.classList.contains("dark-mode")) {
                localStorage.setItem("darkMode", "enabled");
            } else {
                localStorage.setItem("darkMode", "disabled");
            }
        });

        if (localStorage.getItem("darkMode") === "enabled") {
            document.body.classList.add("dark-mode");
        }
    </script>

</body>

</html>