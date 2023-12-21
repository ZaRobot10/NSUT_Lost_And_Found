<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

$item_name = $_POST['item_name'];
$description = $_POST['description'];
$location = $_POST['location'];
$datetime = $_POST['datetime'];
$id = $_SESSION['user_id'];

// File upload
$target_dir = "./uploads/found/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Rename the image with F_ID
$sql = "INSERT INTO Found_item (USER_ID, F_NAME, DESCRIPTION, LOCATION, DATE_TIME) VALUES ('$id', '$item_name', '$description', '$location', '$datetime')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    $newFileName = $target_dir . "F_" . $last_id . "." . $imageFileType;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $newFileName)) {
        echo "<strong>The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded and data has been inserted.</strong><br>";
        echo "<strong>Redirecting</strong>";
        header("refresh:2;url=upload.php?registrationSuccessful=true");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
