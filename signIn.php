<?php
session_start(); 
// Database connection details
include 'conn.php';
// Retrieve user input (email and PRN)
$email = $_POST['email']; // Assuming email is entered via a form input
$prn = $_POST['prn'];     // Assuming PRN is entered via a form input

// SQL query to check if the user exists in the signup table
$sql = "SELECT * FROM `signup` WHERE `email` = '$email' AND `prn` = '$prn'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['email'] = $email;
    header("Location: InOut.php"); // Replace 'new_page.html' with the actual URL
    // You can add further actions here if the user exists.
} else {
echo "<script>
alert('Login Unsuccessful');
window.location.href = 'signIn.html'; 
</script>";
// Replace 'new_page.html' with the actual URL
    // You can add further actions here if the user does not exist.
}
$conn->close();
?>

