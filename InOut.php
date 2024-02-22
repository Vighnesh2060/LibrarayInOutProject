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
    $query = "SELECT * FROM signup WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();


        $profileName = $row['name'];
        $profileEmail = $row['email'];
        $profilePrn = $row['prn'];
        $profileBranch = $row['branch'];
        $profileYear = $row['year'];
    } else {
      echo "<script>
            alert('User not found in the database.');
        window.location.href = 'InOut.php'; 
        </script>";   
    }

    // Close the database connection
    $conn->close();
} else {
  echo "<script>
  alert('You are not logged in.');
window.location.href = 'InOut.php'; 
</script>";   
   
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>InOut</title>
    <style>
        #preloader {
            background:white url(img/preloader4.gif) no-repeat center center;
            height: 100vh;
            width: 100%;
            position: fixed;
            z-index: 100;
            background-size: 30%;
          }
          .log{ 
           
           font-size: 16px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background: linear-gradient(180deg, rgb(23, 63, 95) 5.52%, rgba(23, 63, 95, 0.58) 100%); /* Coral color */
  color: white;
  cursor: pointer;
  transition: background-color 0.3s ease;
            
          }
          .log:hover{
            background: linear-gradient(180deg, rgb(23, 63, 95) 5.52%, rgba(23, 63, 95, 0.58) 100%);
            color: black; /* Gold color - Adjust as needed */

          }
          @media (max-width: 600px){
            #preloader {
                background:white url(img/preloader4.gif) no-repeat center center;
                height: 100vh;
                width: 100%;
                position: fixed;
                z-index: 100;
                background-size: 50%;
               
              }
          }
        .in-out {
            background-color: #ffffff;
            display: flex;
            flex-direction: row;
            justify-content: center;
            width: 100%;
            height: auto;
          }
          
          .in-out .div {
            background-color: #ffffff;
            width: 425px;
            height: 860px;
            position: relative;
            margin-right: 50px;
          }
          
          .in-out .in-button {
            display: flex;
            width: 316px;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 44px 109px;
            position: absolute;
            top: 275px;
            left: 38px;
            border-radius: 68.5px;
            overflow: hidden;
            background: linear-gradient(180deg, rgb(23, 63, 95) 5.52%, rgba(23, 63, 95, 0.58) 100%);
            padding-left: 20px;
            padding-right: 20px;
          }
          
          .in-out .text-wrapper {
            position: relative;
            width: fit-content;
            margin-top: -1px;
            font-family: "Montserrat-Regular", Helvetica;
            font-weight: 400;
            color: #ffffff;
            font-size: 40px;
            letter-spacing: 0;
            line-height: normal;
          }
          
          .in-out .out-button {
            display: flex;
            width: 316px;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 44px 109px;
            position: absolute;
            top: 447px;
            left: 38px;
            background-color: #ffffff;
            border-radius: 68.5px;
            overflow: hidden;
            border: 1px solid;
            border-color: #173f5f;
            padding-left: 20px;
            padding-right: 20px;
            
          }
          
          .in-out .text-wrapper-2 {
            position: relative;
            width: fit-content;
            margin-top: -1px;
            font-family: "Montserrat-Regular", Helvetica;
            font-weight: 400;
            color: #173f5f;
            font-size: 40px;
            letter-spacing: 0;
            line-height: normal;
            
          }
          
          .in-out .dietlogo {
            position: absolute;
            width: 100%;
            height: auto;
            top: 40px;
            left: 27px;
            object-fit: cover;
          }
          
          .in-out .line {
            position: absolute;
            width: 393px;
            height: 1px;
            top: 136px;
            left: 0;
            object-fit: cover;
          }
          section{
            padding-right: 400px;
          }
          .In{
            margin-top: 350px;
            margin-left: 200px;
            border: none;
            outline: none;
          }
        .out{
          margin-top: 150px;
          margin-left: 200px;
          border: none;
          outline: none;
        }
        #profileContainer {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: white;
          color: black;
          z-index: 101; /* Above the preloader */
      }

      #profileContent {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          text-align: center;
      }

      #profileBackBtn {
        font-size: 16px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background: linear-gradient(180deg, rgb(23, 63, 95) 5.52%, rgba(23, 63, 95, 0.58) 100%);/* Coral color */
  color: white;
  cursor: pointer;
  transition: background-color 0.3s ease;
      }
      #profileBackBtn:hover{
        background: linear-gradient(180deg, rgb(23, 63, 95) 5.52%, rgba(23, 63, 95, 0.58) 100%);
            color: black; /* Gold color - Adjust as needed */

      } 
hr{
  width: 120%;
    border: 1px #173F5F solid;
    margin-top: 150px;
    margin-right: 150px;
}
.in-out .in-button.pressed {
    /* Add styling for the pressed state */
    background: linear-gradient(180deg, rgba(23, 63, 95, 0.58) 5.52%, rgb(23, 63, 95) 100%);
    /* Add any other styling you want for the pressed state */
}
#profile{
  padding-top: 30px;
}


    </style>
</head>
  <body>
      <div id="preloader"></div>
      <div class="in-out">
          <div class="div"><hr>
              <div id="profileIcon">
                  <i class="fas fa-user" style="font-size: 32px; cursor: pointer;"></i>
              </div>
              <form action="In.php">
              <button class="In" id="inButton" type="submit" >
                  <div class="in-button"><div class="text-wrapper">IN</div></div>
              </button>
              </form>
              <form action="out.php">
              <button class="out" type="submit">
                  <div class="out-button"><div class="text-wrapper-2">OUT</div></div>
              </button>
              </form>
              <img class="dietlogo" src="img/dietlogo.png" />
          </div>
      </div>

  <form action="InOut.php">
  <div id="profileContainer">
      <button id="profileBackBtn">Back</button>
      <div id="profileContent">
        <h1>Profile</h1>
        <p>Name: <?php echo $profileName; ?></p>
        <p>Email: <?php echo $profileEmail; ?></p>
        <p>PRN: <?php echo $profilePrn; ?></p>
        <p>Branch: <?php echo $profileBranch; ?></p>
        <p>Year: <?php echo $profileYear; ?></p>
        <p><a href="index.html" class="log">Log out</a></p>
      </div>
  </div>
</form>
  <script>
    var loader = document.getElementById("preloader");

    window.addEventListener("load", function () {
        loader.style.display = "none";
    })

    // Function to toggle the profile container
    function toggleProfile() {
        var profileContainer = document.getElementById("profileContainer");
        profileContainer.style.display = profileContainer.style.display === "block" ? "none" : "block";
        document.querySelector(".in-out").style.display = document.querySelector(".in-out").style.display === "none" ? "flex" : "none";
    }

    // Function to add the "pressed" class to the "IN" button
    function pressInButton() {
        var inButton = document.querySelector(".in-out .in-button");
        inButton.classList.add("pressed");
    }

    // Add an event listener for the profile icon
    var profileIcon = document.getElementById("profileIcon");
    profileIcon.addEventListener("click", toggleProfile);

    // Add an event listener for the Back button in the profile view
    var profileBackBtn = document.getElementById("profileBackBtn");
    profileBackBtn.addEventListener("click", toggleProfile);

    // Add an event listener for the "IN" button
    var inButton = document.querySelector(".in-out .in-button");
    inButton.addEventListener("click", pressInButton);
</script>
<script>
  // Function to disable the "In" button
function disableInButton() {
  var inButton = document.querySelector(".in-out .in-button button");
  inButton.disabled = true;
}

// Function to enable the "In" button

function enableInButton() {
  var inButton = document.querySelector(".in-out .in-button button");
  inButton.disabled = false;
}

// Add an event listener for the "IN" button to disable it when clicked
var inButtonElement = document.querySelector(".in-out .in-button button");
inButtonElement.addEventListener("click", function() {
  disableInButton();
});

// Add an event listener for the "OUT" button to enable the "In" button
var outButtonElement = document.querySelector(".in-out .out-button button");
outButtonElement.addEventListener("click", function() {
  enableInButton();
});

</script>


  </body>
  </html>
 
