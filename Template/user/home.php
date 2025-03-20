<?php
    session_start();
    include '../../DB/db.php';
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    $id = $_SESSION['id'];
    $query = "SELECT * FROM user WHERE id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $name = $row['name']?? 'Guest';
    $picture = $row['picture']?? 'logo_1.jpg';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            transition: background 0.3s, color 0.3s;
        }
        .dark-mode {
            background-color: #1e1e2e;
            color: white;
        }
        .sidebar {
            height: 100vh;
            width: 260px;
            background-color: #2a2d3e;
            color: white;
            position: fixed;
            padding-top: 20px;
            transition: all 0.3s;
            box-shadow: 2px 0px 10px rgba(0,0,0,0.2);
        }
        .sidebar a {
            padding: 14px 20px;
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
            font-size: 16px;
            transition: 0.3s;
            border-radius: 8px;
            margin: 8px;
        }
        .sidebar a i {
            margin-right: 12px;
        }
        .sidebar a:hover {
            background-color: #414558;
        }
        .content {
            margin-left: 280px;
            padding: 30px;
            transition: margin-left 0.3s;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }
        .toggle-btn {
            position: fixed;
            top: 15px;
            right: 20px;
            cursor: pointer;
        }
        .rounded-circle {
            box-shadow: 0px 0px 8px rgba(255, 255, 255, 0.5);
        }

    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-center">Admin Panel</h4>
    <a href="dashboard/index.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="#"><i class="fas fa-users"></i> Users</a>
    <a href="#"><i class="fas fa-edit"></i> Posts</a>
    <a href="setting.php"><i class="fas fa-cog"></i> Settings</a>
    <a href="#" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="content">
    <div class="d-flex align-items-center mb-3">
        <img src="../../img/<?php echo $picture; ?>" class="rounded-circle me-3" width="50" height="50" alt="Profile Picture">
        <h2>Welcome, <?php echo $name; ?>!</h2>
    </div>
    <p>Manage your CMS here.</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card p-4 text-white bg-primary">
                <h5><i class="fas fa-user"></i> Total Users</h5>
                <p>120</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 text-white bg-success">
                <h5><i class="fas fa-file-alt"></i> Total Posts</h5>
                <p>45</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 text-white bg-danger">
                <h5><i class="fas fa-comments"></i> Pending Comments</h5>
                <p>10</p>
            </div>
        </div>
    </div>
</div>

<i class="fas fa-moon fa-lg toggle-btn mt-3" id="darkModeToggle"></i>

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
