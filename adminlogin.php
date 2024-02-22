<?php 
include 'conn.php';
// Database connection details
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "libarayinout";

// // Create a new MySQLi connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check the connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Retrieve user input from the form (make sure to sanitize and validate)
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to select the user with the provided email and password
$sql = "SELECT * FROM adminlogin WHERE email = '$email' AND password = '$password'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Login successful, redirect to the next page
    header("Location: adminprofile.html"); // Replace 'new_page.html' with the actual URL
     // Ensure script execution stops after the redirect
} else {
    echo "<script>
alert('Login Unsuccessful');
window.location.href = 'adminLogin.html'; 
</script>";
}

$conn->close();
?>
