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
    <title>Found Form</title>
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
    text-align: center;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="datetime-local"] {
    width: calc(100% - 20px);
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ddd;
    margin-top: 5px;
}

input[type="file"] {
    width: calc(100% - 20px);
    padding: 4px;
    border-radius: 5px;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
    cursor: pointer;
    height: 28px;
    margin-top: 5px;
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
        <h1>Found</h1>
        <div class="box">
            <h2>Choose an Option</h2>
            <div class="input-group">
                <button id="searchButton" class="submit-button">Search</button>
                <button id="uploadButton" class="submit-button">Upload</button>
            </div>
        </div>
        <button id="returnButton" class="return-button">Return</button>
    </div>

    <script>
    document.getElementById("uploadButton").addEventListener("click", function() {
        window.location.href = "upload.php";
    });

    document.getElementById("searchButton").addEventListener("click", function() {
        window.location.href = "search.php";
    });

    document.getElementById("returnButton").addEventListener("click", function() {
        window.location.href = "to_where.php";
    });

</script>
</body>

</html>
