<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #f8f9fa;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }
        .header a {
            margin-right: 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .header a:hover {
            color: #0056b3;
        }
        .header .logout {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container-fluid bg-primary text-white py-2">
        <div class="container d-flex">
            <div class="col-6">
               <a href="user_task_list.php" class="text-white" style="text-decoration:none"><h5  class="mb-0">Dashboard</h5></a> 
            </div>
            <div class="col-6 text-end text-white   ">
                <a href="user_task_list.php" class="btn btn-sm btn-warning">Your Task List</a>
                <a href="user_task.php" class="btn btn-sm btn-warning">Submit Task</a>
                <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
