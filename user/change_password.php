<?php

session_start();
include '../db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); 
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    
    if ($new_password !== $confirm_password) {
        echo "<div class='alert alert-success'>New password and confirmation do not match.</div>";
    } else {
        
        $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);
        $update_query = "UPDATE users SET password = '$hashed_new_password', last_password_change = NOW() WHERE id = $user_id";
        if (mysqli_query($conn, $update_query)) {
            echo "<div class='alert alert-success'>Password changed successfully! You are now logged in.</div>";
            
            $update_last_login = "UPDATE users SET last_login = NOW() WHERE id = $user_id";
            mysqli_query($conn, $update_last_login);

            header("Location: user_task_list.php");
            exit;
        } else {
            echo "Error updating password: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Change Password</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter new password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Re-enter new password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Change Password</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>