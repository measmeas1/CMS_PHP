<?php
session_start();
include '../../DB/db.php';

// Check if the logged-in user is an admin
if (!isset($_SESSION['id']) || $_SESSION['is_admin'] != 1) {
    $self_user = true;
} else {
    $self_user = false;
}

// Validate user ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>window.location.href='dashboard/tables.php';</script>";
    exit();
}

$user_id = intval($_GET['id']);

// Prevent self-role modification
if ($user_id == $_SESSION['id']) {
    $self_role_error = true; // Set error flag for modal
} else {
    $self_role_error = false;

    // Fetch user details
    $result = mysqli_query($con, "SELECT id, name, email, is_admin FROM user WHERE id='$user_id'");
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "<script>alert('User not found!'); window.location.href='dashboard/tables.php';</script>";
        exit();
    }

    // Handle role update
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_role = isset($_POST['is_admin']) ? 1 : 0; // Checkbox checked means Admin
        mysqli_query($con, "UPDATE user SET is_admin='$new_role' WHERE id='$user_id'");

        // Redirect back to user list
        echo "<script>window.location.href='dashboard/tables.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change User Role</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-5">

        <?php if ($self_role_error) { ?>
            <!-- Bootstrap Modal -->
            <div class="modal fade show" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" style="display: block;" aria-modal="true" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger">Warning</h5>
                        </div>
                        <div class="modal-body">
                            <p>You cannot change your own role!</p>
                        </div>
                        <div class="modal-footer">
                            <a href="dashboard/tables.php" class="btn btn-secondary">OK</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($self_user) { ?>
            <div class="modal fade show" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" style="display: block;" aria-modal="true" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger">Warning</h5>
                        </div>
                        <div class="modal-body">
                            <p>Access Denied! You are not admin!</p>
                        </div>
                        <div class="modal-footer">
                            <a href="dashboard/tables.php" class="btn btn-secondary">OK</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>

            <form method="POST">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin"
                        <?php echo ($user['is_admin'] == 1) ? "checked" : ""; ?>>
                    <label class="form-check-label" for="is_admin">Make Admin</label>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                <a href="dashboard/tables.php" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        <?php } ?>
    </div>

</body>

</html>