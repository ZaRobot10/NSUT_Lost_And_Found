<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] !== 'Admin') {
    // Redirect to to_where.php
    header("Location: to_where.php");
    exit();
}
?>


<?php
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

// Search functionality
if (isset($_POST['search_date'])) {
    $searchDate = $_POST['search_date'];

    $sql = "SELECT * FROM Claimed_item WHERE DATE_TIME LIKE '%$searchDate%'";
} elseif (isset($_POST['search_user_id'])) {
    $searchUserId = $_POST['search_user_id'];

    $sql = "SELECT * FROM Claimed_item WHERE CLAMINGUSER_ID = '$searchUserId'";
} else {
    // Fetch all records from the Claim table
    $sql = "SELECT * FROM Claimed_item";
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claims</title>
    <style>
        h2{
            text-align: center;
            font-size: 50px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        form {
            margin-top: 20px;
        }
        .return-button {
    position: fixed;
    top: 20px;
    right: 20px; /* Change left to right */
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

<h2>Claims</h2>
<button id="returnButton" class="return-button">Return</button>

<!-- Search form -->
<form method="post" action="claims.php">
    <label for="search_date">Search by Date:</label>
    <input type="text" name="search_date" placeholder="YYYY-MM-DD">
    <button type="submit" name="search_date_btn">Search by Date</button>
</form>

<form method="post" action="claims.php">
    <label for="search_user_id">Search by User ID:</label>
    <input type="text" name="search_user_id">
    <button type="submit" name="search_user_id_btn">Search by User ID</button>
</form>

<!-- Display table of claims -->
<table>
    <tr>
        <th>Claim ID</th>
        <th>F_ID</th>
        <th>Claiming User ID</th>
        <th>Date and Time</th>
        <th>Object Name</th>
        <th>Description</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["CLAIM_ID"] . "</td>";
            echo "<td>" . $row["F_ID"] . "</td>";
            echo "<td>" . $row["CLAMINGUSER_ID"] . "</td>";
            echo "<td>" . $row["DATE_TIME"] . "</td>";
            echo "<td>" . $row["OBJECT_NAME"] . "</td>";
            echo "<td>" . $row["Description"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

<script>

document.getElementById("returnButton").addEventListener("click", function() {
        window.location.href = "to_where.php";
    });
</script>
