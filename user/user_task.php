<?php
include '../db_connection.php';
include 'user_header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $start_time = $_POST['start_time'];
    $stop_time = $_POST['stop_time'];
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if (strtotime($stop_time) <= strtotime($start_time)) {
        echo "<div class='alert alert-danger'>Stop time must be later than start time.</div>";
    } else {
        $query = "INSERT INTO tasks (user_id, start_time, stop_time, notes, description) 
                  VALUES ($user_id, '$start_time', '$stop_time', '$notes', '$description')";

        if (mysqli_query($conn, $query)) {
            echo "<div class='alert alert-success'>Task submitted successfully!</div>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<div class="container">
    <div class="form-container border p-4 m-4">
        <h2>Submit Your Task</h2>
        <form method="POST">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time:</label>
                        <input type="datetime-local" name="start_time" class="form-control" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="stop_time" class="form-label">Stop Time:</label>
                        <input type="datetime-local" name="stop_time" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notes:</label>
                <textarea name="notes" class="form-control" placeholder="Enter notes" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" class="form-control" placeholder="Enter description" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Task</button>
        </form>
    </div>
</div>