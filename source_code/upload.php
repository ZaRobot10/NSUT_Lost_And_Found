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
    <title>Upload Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
            margin: 0;
        }

        .container {
            text-align: center;
        }

        .box {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin-top: 50px;
        }

        h1 {
            font-size: 75px;
            margin-bottom: 0px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="datetime-local"] {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .submit-button {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-button:hover {
            background-color: #45a049;
        }

        input[type="file"] {
            width: 100%;
            padding: 4px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            cursor: pointer;
            height: 28px;
        }

        input[type="file"]::file-selector-button {
            padding: 4px 10px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        input[type="file"]::file-selector-button:hover {
            background-color: #45a049;
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
        <h1><u>Upload</u></h2>
        <div class="box">
            <form action="store_upload.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="item_name">Item Name:</label>
                    <input type="text" id="item_name" name="item_name" required>
                </div>

                <div class="input-group">
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" required>
                </div>

                <div class="input-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" required>
                </div>

                <div class="input-group">
                    <label for="datetime">Date and Time:</label>
                    <input type="datetime-local" id="datetime" name="datetime" required>
                </div>

                <div class="input-group">
                    <label for="image">Select image:</label>
                    <input type="file" id="image" name="image" required>
                </div>

                <div class="input-group">
                    <button type="submit" class="submit-button">Submit</button>
                </div>
            </form>
        </div>
        <button id="returnButton" class="return-button">Return</button>
    </div>
</body>
</html>

<script>

document.getElementById("returnButton").addEventListener("click", function() {
        window.location.href = "found.php";
    });
</script>
