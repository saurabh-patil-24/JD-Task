<?php

include '../db_connection.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="tasks_report.csv"');

$output = fopen("php://output", "w");
fputcsv($output, ['Start Time', 'Stop Time', 'Notes', 'Description']);

$query = "SELECT start_time, stop_time, notes, description FROM tasks";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
