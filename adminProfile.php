<?php

// Database connection details
include 'conn.php';
// SQL query to select data from your table
$sql = "SELECT * FROM entry";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Define a filename for the CSV file
    $filename = "exported_data.csv";

    // Set appropriate headers for the CSV file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Open a writable stream to the output buffer
    $output = fopen('php://output', 'w');

    // Add a header row to the CSV file
    $header = array("name","branch", "year","timestamp", "STATUS"); // Replace with your actual column names
    fputcsv($output, $header);

    // Loop through the result set and add data to the CSV file
    while ($row = $result->fetch_assoc()) {
        $data = array($row['name'], $row['branch'],$row['year'],$row['timestamp'],$row['STATUS']); // Replace with your actual column names
        fputcsv($output, $data);
    }

    // Close the output stream
    fclose($output);
} else {
    echo "No data found in the table.";
}

$sql = "SELECT * FROM quit";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Define a filename for the CSV file
    $filename = "monthly_data.csv";

    // Set appropriate headers for the CSV file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Open a writable stream to the output buffer
    $output = fopen('php://output', 'w');

    // Add a header row to the CSV file
    $header = array("name", "branch", "year","timestamp", "STATUS"); // Replace with your actual column names
    fputcsv($output, $header);

    // Loop through the result set and add data to the CSV file
    while ($row = $result->fetch_assoc()) {
        $data = array($row['name'], $row['branch'],$row['year'],$row['timestamp'],$row['STATUS']); // Replace with your actual column names
        fputcsv($output, $data);
    }

    // Close the output stream
    fclose($output);
} else {
    echo "No data found in the table.";
}



// Close the database connection
$conn->close();
?>
<?php
// Database connection details
include 'conn.php';

// Create a new MySQLi connection


// Define the table names
$tableName1 = "quit";
$tableName2 = "entry";

// SQL query to truncate the first table
$sql1 = "TRUNCATE TABLE $tableName1";
// SQL query to truncate the second table
$sql2 = "TRUNCATE TABLE $tableName2";

// Execute the first SQL query
if ($conn->query($sql1) === TRUE) {
    
} else {
   
}

// Execute the second SQL query
if ($conn->query($sql2) === TRUE) {
  
} else {
  
}

// Close the database connection
$conn->close();
?>
