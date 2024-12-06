<?php
include '../db_connection.php';
include 'user_header.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM tasks WHERE user_id = $user_id ORDER BY start_time DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Submitted Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 20px;
        }
        .table th, .table td {
            text-align: center;
        }
        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <h2 class="text-center mb-4">Your Submitted Tasks</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Start Time</th>
                        <th>Stop Time</th>
                        <th>Notes</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($task = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo date('Y-m-d H:i:s', strtotime($task['start_time'])); ?></td>
                            <td><?php echo date('Y-m-d H:i:s', strtotime($task['stop_time'])); ?></td>
                            <td><?php echo htmlspecialchars($task['notes']); ?></td>
                            <td><?php echo htmlspecialchars($task['description']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    <?php } else { ?>
        <div class="welcome-message">
            <h3>Welcome! It looks like you haven't submitted any tasks yet.</h3>
            <p>Your tasks will show here once submitted. Please go ahead and submit your first task.</p>
        </div>
    <?php } ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
