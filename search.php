<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    background-color: #f2f2f2;
}

button.claim-button {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    margin-left: 30px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button.claim-button:hover {
    background-color: #45a049;
}
.container {
    text-align: center;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 80%; /* Adjust the width as needed */
    border: 2px solid #333; /* Add border styling */
}

h1 {
    color: #333;
    margin-bottom: 20px; /* Add some spacing between the heading and content */
}

.box {
    border: 2px solid #ddd; /* Add border styling for each box */
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px; /* Adjust the spacing between boxes */
}

/* Add your additional styling as needed */
p {
    margin-bottom: 10px;
}

img {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}


.item-number {
    position: absolute;
    top: 10px;
    left: 10px;
    font-weight: bold;
}

.inner-box {
    padding: 15px;
    border: 2px solid #ddd; /* Add border styling for each inner box */
    border-radius: 8px;
    margin-top: 20px; /* Adjust the spacing between inner boxes */
    position: relative; /* Set position to relative for absolute positioning of item number */
}

.return-button {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background-color: #4CAF50;
    color: #ffffff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.return-button:hover {
    background-color: #45a049;
}
    </style>
    
</head>
<body>
    <div class="container">
        <h1>FOUND ITEMS</h1>
        <button id="returnButton" class="return-button">Return</button>
        
<?php
$hostname = 'localhost'; // Replace with your hostname
$username = 'root'; // Replace with your username
$password = ''; // Replace with your password
$database = 'lostandfound'; // Replace with your database name


// Create connection
$conn = new mysqli($hostname, $username, $password, $database);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- <div class='box'> -->
<?php


// Fetch details from the "Lost" table
$sql = "SELECT F_ID, F_NAME, DESCRIPTION, LOCATION, DATE_TIME FROM Found_item";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $itemNumber = 1; // Initialize item number counter

    while ($row = $result->fetch_assoc()) {
        // Display each record in a separate box
        
        
        echo "<div class='inner-box'>"; // Innermost box
        echo "<p class='item-number'><strong>" . $itemNumber . ".</strong></p>";
        echo "<p><strong>Item Name:</strong> " . $row["F_NAME"] . "</p>";
        echo "<p><strong>Description:</strong> " . $row["DESCRIPTION"] . "</p>";
        echo "<p><strong>Location:</strong> " . $row["LOCATION"] . "</p>";
        echo "<p><strong>Date and Time:</strong> " . $row["DATE_TIME"] . "</p>";

        // Display the corresponding image using L_ID
        $imageFormats = ['jpg', 'jpeg', 'png'];
        $foundImage = false;

        foreach ($imageFormats as $format) {
            $imageFileName = "uploads/found/F_" . $row["F_ID"] . "." . $format;
            if (file_exists($imageFileName)) {
                echo "<img src='$imageFileName' alt='Lost Item Image' style='max-width: 300px;'>";
                $foundImage = true;
                break;
            }
        }

        if (!$foundImage) {
            echo "<p>No image available</p>";
        }
        else {
            // Add a claim button
            if ($_SESSION['role'] == "Admin") {
                echo "<button class='claim-button' style='font-size: 1.5em;' data-fid='" . $row["F_ID"] . "' data-name='" . $row["F_NAME"] . "' data-description='" . $row["DESCRIPTION"] . "' data-datetime='" . $row["DATE_TIME"] . "' data-userid='" . $_SESSION['user_id'] . "' onclick='claimItem(this)'>Claim</button>";
            }
        }

        echo "</div>"; // Close inner box
        

        $itemNumber++; // Increment item number for the next iteration
    }
} else {
    echo "No records found";
}
?>
<!-- </div> -->

    <?php
        $conn->close();
    ?>

</div>

</body>
</html>

<script>
// JavaScript function to handle the claim action
function claimItem(button) {
    // Extract data from data attributes
    var fid = button.getAttribute('data-fid');
    var name = button.getAttribute('data-name');
    var description = button.getAttribute('data-description');
    var datetime = button.getAttribute('data-datetime');
    var userid = button.getAttribute('data-userid');

    // Redirect to process_claim.php with the necessary data
    window.location.href = 'process_claim.php?fid=' + fid + '&name=' + encodeURIComponent(name) + '&description=' + encodeURIComponent(description) + '&datetime=' + encodeURIComponent(datetime) + '&userid=' + userid;
}
</script>

<script>

document.getElementById("returnButton").addEventListener("click", function() {
        window.location.href = "found.php";
    });
</script>