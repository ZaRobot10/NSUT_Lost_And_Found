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
    <title>Lost Items</title>
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

        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            border: 2px solid #333;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .box {
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
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
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-top: 20px;
            position: relative;
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

        .delete-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff0000;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
    </style>

</head>
<body>
<div class="container">
    <h1>LOST ITEMS</h1>
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

    // Fetch details from the "Lost" table
    $sql = "SELECT L_ID, L_NAME, DESCRIPTION, LOCATION, DATE_TIME FROM Lost_item";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $itemNumber = 1; // Initialize item number counter

        while ($row = $result->fetch_assoc()) {
            // Display each record in a separate box
            echo "<div class='inner-box'>"; // Innermost box
            echo "<p class='item-number'><strong>" . $itemNumber . ".</strong></p>";
            echo "<p><strong>Item Name:</strong> " . $row["L_NAME"] . "</p>";
            echo "<p><strong>Description:</strong> " . $row["DESCRIPTION"] . "</p>";
            echo "<p><strong>Location:</strong> " . $row["LOCATION"] . "</p>";
            echo "<p><strong>Date and Time:</strong> " . $row["DATE_TIME"] . "</p>";

            // Display the corresponding image using L_ID
            $imageFormats = ['jpg', 'jpeg', 'png'];
            $foundImage = false;

            foreach ($imageFormats as $format) {
                $imageFileName = "uploads/lost/L_" . $row["L_ID"] . "." . $format;
                if (file_exists($imageFileName)) {
                    echo "<img src='$imageFileName' alt='Lost Item Image' style='max-width: 300px;'>";
                    $foundImage = true;
                    break;
                }
            }

            if (!$foundImage) {
                echo "<p>No image available</p>";
            }

            // Delete button (display only for Admin)
            if ($_SESSION['role'] === 'Admin') {
                echo "<button class='delete-button' onclick='deleteLostItem(" . $row["L_ID"] . ")'>Delete</button>";
            }

            echo "</div>"; // Close inner box

            $itemNumber++; // Increment item number for the next iteration
        }
    } else {
        echo "No records found";
    }
    ?>
</div>

<script>
    document.getElementById("returnButton").addEventListener("click", function () {
        window.location.href = "lost.php";
    });

    function deleteLostItem(itemId) {
        if (confirm("Are you sure you want to delete this item?")) {
            // Redirect to delete_lost.php with the item ID
            window.location.href = "delete_lost.php?l_id=" + itemId;
        }
    }
</script>
</body>
</html>
