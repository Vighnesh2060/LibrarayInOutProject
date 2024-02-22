<?php
session_start(); 
include 'conn.php';
// Retrieve user input from the form (make sure to sanitize and validate)
$branch = $_POST['branch'];
$year = $_POST['year'];
$prn = $_POST['prn'];
$email = $_POST['email'];
$name = $_POST['name'];

// SQL query to insert data into the signup table
$sql = "INSERT INTO `signup`(`branch`, `year`, `prn`, `email`, `name`) VALUES ('$branch','$year','$prn','$email','$name')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['email'] = $email;
    header("Location: InOut.php"); // Replace 'new_page.html' with the actual URL
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

