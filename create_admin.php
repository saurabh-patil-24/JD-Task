<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<?php
include 'db_connection.php'; 

$admin_email = 'admin@gmail.com';
$admin_password = 'admin123';
$hashed_password = password_hash($admin_password, PASSWORD_BCRYPT);

$check_query = "SELECT * FROM admins WHERE email = '$admin_email'";
$result = mysqli_query($conn, $check_query);
if (mysqli_num_rows($result) > 0) {
    echo "<div class='alert alert-danger'>Admin already exists.</div>";
} else {
    $insert_query = "INSERT INTO admins (email, password) VALUES ('$admin_email', '$hashed_password')";
    if (mysqli_query($conn, $insert_query)) {
        echo "<div class='alert alert-success'>Admin created successfully.<br></div>";
        echo "<div class='alert alert-secondary text-success'>Username: $admin_email<br></div>";
        echo "<div class='alert alert-secondary text-success'>Password: $admin_password</div>";
        echo "<div class='alert alert-secondary text-success text-center'><a href='login.php' class='text-primary'>Go to Login</a></div>";

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn); 
?>
