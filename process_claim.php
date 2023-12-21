<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>

<?php
// Set the timezone to IST
date_default_timezone_set('Asia/Kolkata');

// Check if the necessary parameters are set
if (isset($_GET['fid']) && isset($_GET['name']) && isset($_GET['description']) && isset($_GET['datetime']) && isset($_GET['userid'])) {
    $fid = $_GET['fid'];
    $name = urldecode($_GET['name']);
    $description = urldecode($_GET['description']);
    $datetime = urldecode($_GET['datetime']);
    $userid = $_GET['userid'];
} else {
    // Handle the case when parameters are not set
    echo "Invalid request. Please provide necessary parameters.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Item Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        #claiminguserid {
    font-size: 14px;
    width: 50%; /* Adjust the width as needed */
    max-width: 300px; /* Set a maximum width if necessary */
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

<h1>Claim Item Form</h1>

<div class="container">
    <form action="submit_claim.php" method="post">
        <!-- Hidden fields to store data -->
        <p><strong>F_ID:</strong> <?php echo $fid; ?></p>
        <input type="hidden" name="fid" value="<?php echo $fid; ?>">
        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
        

        <!-- Prefilled values for reference -->
        <p><strong>Item Name:</strong> <?php echo $name; ?></p>
        <p><strong>Description:</strong> <?php echo $description; ?></p>
        <p><strong>Claiming Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>

        <!-- Form fields for claiming user input -->
        <label for="claiminguserid">Claiming User ID:</label>
        <input type="text" id="claiminguserid" name="claiminguserid" required>

        <input type="hidden" name="claimdescription" value="<?php echo $description; ?>">

        <!-- Prefilled values for claiming -->
        <input type="hidden" name="objectname" value="<?php echo $name; ?>">

        <!-- Prefill date and time with current system date and time -->
        <input type="hidden" name="claimdatetime" value="<?php echo date('Y-m-d H:i:s'); ?>">

        <button type="submit">Submit Claim</button>
    </form>
    <button id="returnButton" class="return-button">Return</button>
</div>

</body>
</html>

<script>

document.getElementById("returnButton").addEventListener("click", function() {
        window.location.href = "search.php";
    });
</script>