<?php
include 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $query_admin = "SELECT * FROM admins WHERE email = '$email'";
    $result_admin = mysqli_query($conn, $query_admin);

    if (mysqli_num_rows($result_admin) === 1) {
        $admin = mysqli_fetch_assoc($result_admin);
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            header("Location: admin/admin_dashboard.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Invalid email or password for Admin.</div>";
        }
    } else {
        
        $query_user = "SELECT * FROM users WHERE email = '$email'";
        $result_user = mysqli_query($conn, $query_user);

        if (mysqli_num_rows($result_user) === 1) {
            $user = mysqli_fetch_assoc($result_user);
           
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    if ($user['last_password_change'] == NULL || (time() - strtotime($user['last_password_change'])) / (60 * 60 * 24) > 30) {
                        header("Location: user/change_password.php");
                        exit;
                    }
                    $update_last_login = "UPDATE users SET last_login = NOW() WHERE id = " . $user['id'];
                    mysqli_query($conn, $update_last_login);
                    header("Location: user/user_task_list.php");
                    exit;
                } 
                else if (md5($password) === $user['password']) {
                    $_SESSION['user_id'] = $user['id'];
                    if ($user['last_password_change'] == NULL || (time() - strtotime($user['last_password_change'])) / (60 * 60 * 24) > 30) {
                        header("Location: user/change_password.php");
                        exit;
                    }
                    $update_last_login = "UPDATE users SET last_login = NOW() WHERE id = " . $user['id'];
                    mysqli_query($conn, $update_last_login);
                    header("Location: user/user_task_list.php");
                    exit;
                }  else {
                    echo "<div class='alert alert-danger'>Invalid email or password for User.</div>";
                }
        } else {
            echo "<div class='alert alert-danger'>User not found.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center">Login</h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
