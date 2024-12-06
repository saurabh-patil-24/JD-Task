<?php
include '../db_connection.php';
include 'admin_header.php';


if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);


if (isset($_GET['reset_password']) && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    
    $new_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$'), 0, 10);
    
    $md5_password = md5($new_password);

    $query_user = "SELECT * FROM users WHERE id = $user_id";
    $result_user = mysqli_query($conn, $query_user);
    $user = mysqli_fetch_assoc($result_user);
    $user_name = $user['first_name'] . ' ' . $user['last_name']; 
        
    $update_query = "UPDATE users SET password = '$md5_password' WHERE id = $user_id";
    if (mysqli_query($conn, $update_query)) {
        echo "<div class='alert alert-success'>Password for $user_name has been reset successfully. New MD5 is Password: $new_password</div>";
    } else {
        echo "<div class='alert alert-danger'>Failed to reset the password.</div>";
    }
}
?>

<div class="container mt-4">
    <h3 class="text-center">Welcome, Admin</h3>
    <?php
        if (mysqli_num_rows($result) > 0) {
    ?>
    <h4>Users List</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['first_name'] . " " . $user['last_name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td>
                        <a href="?reset_password=true&user_id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Reset Password</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
        }
        else
        {
    ?>
        <h4 class="text-warning text-center">No users available. Go ahead and create users.</h4>
    <?php
        }
    ?>
</div>
