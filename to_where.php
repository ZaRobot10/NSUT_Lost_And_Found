<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();

    
}

if (isset($_POST['sign_out'])) {
        // Destroy the session and redirect to login.php
        session_destroy();
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .container {
    text-align: center;
}

.box {
    background-color: #ffffff;
    padding: 50px;
    padding-top: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 500px; /* Adjusted width to 500px */
    margin-top: 50px;
}
body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f2f2f2;
    margin: 0;
}

h1 {
    font-size: 75px;
    margin-bottom: 0px;
}

h2 {
    font-size: 2em; /* Adjusted font size for h2 */
    margin-bottom: 20px; /* Adjusted margin */
}

.buttons {
    gap: 20px;
}

.submit-button {
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2em; /* Adjusted font size for buttons */
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


.submit-button:hover {
    background-color: #45a049;
}
        .sign-out-button {
            position: absolute;
            top: 10px;
            right: 10px; /* Adjusted to top right */
            background-color: #ff0000; /* Red color */
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
        
    </style>
    <title>Student Page</title>
</head>
<body>
    <!-- Sign Out Button -->
<form method="post">
    <button class="sign-out-button" type="submit" name="sign_out">Sign Out</button>
</form>

<div class="container">
        <div class="box">
            <h2>Choose an Option</h2>
            <div class="buttons">
        <button class="submit-button" onclick="redirectToLost()">Lost</button>
        <button class="submit-button" onclick="redirectToFound()">Found</button>
        <!-- Claims Button (displayed only for Admin) -->
<?php if ($_SESSION['role'] == "Admin"): ?>
    <button class="submit-button" onclick="redirectToClaims()">Claims</button>
<?php endif; ?>
    </div>
        </div>
        
    </div>


    <script>
        function redirectToLost() {
            window.location.href = "lost.php";
        }

        function redirectToFound() {
            window.location.href = "found.php";
        }
        function redirectToClaims() {
            window.location.href = "claims.php";
        }

    </script>
</body>
</html>
