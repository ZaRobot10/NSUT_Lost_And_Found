<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] !== 'Admin') {
    // Redirect to to_where.php
    header("Location: lost.php");
    exit();
}
?>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the user has the Admin role
if ($_SESSION['role'] !== 'Admin') {
    // Redirect to a suitable page (e.g., access denied page)
    header("Location: access_denied.php");
    exit();
}

// Check if the L_ID parameter is provided
if (isset($_GET['l_id'])) {
    $itemId = $_GET['l_id'];

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

    // SQL to delete the lost item
    $sql = "DELETE FROM Lost_item WHERE L_ID = $itemId";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful, redirect to the lost items page
        echo "<strong>Deletion was successful</strong><br>";
        echo "<strong>Redirecting</strong>";
        header("refresh:2;url=lost_search.php?registrationSuccessful=true");
        
        exit();
    } else {
        // Error in deletion, display an error message
        echo "Error deleting item: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // L_ID parameter not provided, redirect to an error page or the lost items page
    header("Location: error_page.php");
    exit();
}
?>
