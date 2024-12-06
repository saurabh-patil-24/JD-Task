<?php

include '../db_connection.php';
include 'admin_header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = isset($_POST['auto_generate']) ? substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$'), 0, 10) : $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (first_name, last_name, email, phone, password) VALUES ('$first_name', '$last_name', '$email', '$phone', '$hashed_password')";
    mysqli_query($conn, $query);

    echo "<div class='alert alert-success'>User created successfully. Password: $password</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Create New User</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="auto_generate" class="form-check-input" id="auto_generate">
                    <label class="form-check-label" for="auto_generate">Auto-generate password</label>
                </div>

                <button type="submit" class="btn btn-primary w-25">Create User</button>
            </form>
        </div>
    </div>
</div>