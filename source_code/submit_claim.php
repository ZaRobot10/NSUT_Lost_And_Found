<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>

<?php
// Check if the form is submitted
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $fid = $_POST["fid"];
    $claimingUserId = $_POST["claiminguserid"];
    $objectName = $_POST["objectname"];
    $claimDateTime = $_POST["claimdatetime"];
    $description = $_POST["claimdescription"]; // Update the key to "claimdescription"

    // Database connection details
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


    // Insert data into the "Claim" table
    $sql = "INSERT INTO Claimed_item (F_ID, CLAMINGUSER_ID, DATE_TIME, OBJECT_NAME, Description) VALUES ('$fid', '$claimingUserId', '$claimDateTime', '$objectName', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Claim submitted successfully!";
        $sqlDelete = "DELETE FROM Found_item WHERE F_ID = '$fid'";
        if ($conn->query($sqlDelete) === TRUE) {
            echo "Found item deleted successfully!";
        } else {
            echo "Error deleting found item: " . $conn->error;
        }
        header("Location: search.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} 
else {
    echo "Invalid request. Please submit the form.";
}
?>
