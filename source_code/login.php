<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 50px;
            color: red;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Use 100vh to cover the entire viewport height */
            margin: 0;
            background-image: url('background.jpeg'); /* Add your background image file path */
            background-size: cover; /* Cover the entire viewport */
            background-position: center;
        }

        .container {
            width: 350px; /* Set the width of the container */
            background-color: rgba(255, 255, 255, 0.8); /* Add opacity to the container background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h2 {
            margin-bottom: 20px;
        }

        .branding-line {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            animation: blink 1s infinite; /* Add animation to make it blink */
            color: green;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <!-- <img src="Applications/XAMPP/htdocs/project/nsutlogo.png" alt="NSUT Logo" style="width: 150px; height: 150px; margin-bottom: 20px;"> -->
    <img src="nsutlogo.png" alt="NSUT Logo" style="width: 1000px; height: 100px; margin-bottom: 20px;">

    <h1><u>NSUT LOST AND FOUND</u></h1>
    <p class="branding-line"><u><i>Lost it - List it - Found it</i></u></p>
    <div class="container">
        <h2>LOGIN :-</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            ID: <input type="text" name="id"><br><br>
            Password: <input type="password" name="password"><br><br>
            <input type="submit" name="submit" value="Sign In">
        </form>
        <br>
        <form method="post" action="register.php">
            <input type="submit" name="submit" value="Sign Up">
        </form>

        <?php

        if (isset($_GET['registrationSuccessful']) && $_GET['registrationSuccessful'] == 'true') {
            echo "<h2>Registration Successful</h2>";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hostname = 'localhost'; // Replace with your hostname
            $username = 'root'; // Replace with your username
            $password = ''; // Replace with your password
            $database = 'lostandfound'; // Replace with your database name

            $connection = new mysqli($hostname, $username, $password, $database);

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $id = $_POST['id'];
            $password = $_POST['password'];

            // Hash the password
            // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Perform your query to check if the ID and hashed password match a record in your database
            $query = "SELECT * FROM user WHERE user_id='$id'";
            $result = $connection->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                $hashed_password_from_db = $row['PASSWORD'];

                if (password_verify($password, $hashed_password_from_db)) {
                    // Redirect to the to where page if the login is successful
                    session_start();
                    $_SESSION['user_id'] = $row['USER_ID'];
                    $_SESSION['username'] = $row['USERNAME'];
                    $_SESSION['role'] = $row['ROLE'];
                    header("Location: to_where.php");
                    exit();
                } else {
                    echo "Invalid password. Please try again.";
                }
            } else {
                echo "Invalid ID. Please try again.";
            }

            $connection->close();
        }
        ?>
    </div>
</body>

</html>
