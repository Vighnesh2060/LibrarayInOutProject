<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);

session_start();

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // User is logged in, fetch user data from the database
    include 'conn.php';
    $email = $_SESSION['email'];

    // Fetch user data from the database
    $query = "SELECT * FROM signup WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $user_id = $row['id'];
        $profileName = $row['name'];
        $profileEmail = $row['email'];
        $profilePrn = $row['prn'];
        $profileBranch = $row['branch'];
        $profileYear = $row['year'];
        $STATUS = 'OUT successfully';

        // Get the current UTC timestamp
        $utcTimestamp = gmdate('Y-m-d H:i:s');

        // Convert UTC to IST
        $utcDateTime = new DateTime($utcTimestamp, new DateTimeZone('UTC'));
        $utcDateTime->setTimezone(new DateTimeZone('Asia/Kolkata'));
        $istTimestamp = $utcDateTime->format('Y-m-d H:i:s');

        // Insert data into the 'quit' table with IST timestamp
        $outQuery = "INSERT INTO quit (user_id, name, email, prn, branch, year, timestamp, STATUS) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($outQuery);
        $stmt->bind_param("isssssss", $user_id, $profileName, $profileEmail, $profilePrn, $profileBranch, $profileYear, $istTimestamp, $STATUS);

        if ($stmt->execute()) {
            echo "<script>
            alert('OUT entry added successfully.');
        window.location.href = 'InOut.php'; 
        </script>";
           
        } else {
            echo "<script>
            alert('Something went Wrong.');
        window.location.href = 'InOut.php'; 
        </script>";
        }
    } else {
        echo "<script>
        alert('User not found in the database.');
    window.location.href = 'InOut.php'; 
    </script>";
       
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {

}
?>
