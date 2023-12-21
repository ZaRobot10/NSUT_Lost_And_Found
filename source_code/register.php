<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('reg_back.png'); /* Add your background image file path */
            background-size: cover; /* Cover the entire viewport */
            background-position: center;
            margin: 0;
            padding: 0;
        }
        form {
            max-width: 300px;
            margin: 0 auto;
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #c3c3c3;
        }
        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }
        
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #0098cb;
            border: 0;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #0086b3;
        }
        h2 {
            text-align: center;
            color: #fff; /* Set text color to white */
        }
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <h2><u>Registration Form</u></h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        User ID: <input type="text" name="user_id" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        Name: <input type="text" name="name" required><br><br>
        Role:
        <select name="role" required>
            <option value="">-- Select Role --</option>
            <option value="Student">Student</option>
            <option value="Staff">Staff</option>
        </select><br><br>
        Date of Birth: <input type="date" name="dob" required><br><br>
        Contact Number: <input type="text" name="contact_num" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        <input type="submit" name="submit" value="Register">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hostname = 'localhost'; // Replace with your hostname
        $username = 'root'; // Replace with your username
        $password = ''; // Replace with your password
        $database = 'lostandfound'; // Replace with your database name


        $connection = new mysqli($hostname, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
       
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $name = $_POST['name'];
        $role = $_POST['role'];
        $dob = $_POST['dob'];
        $contact_num = $_POST['contact_num'];
        $email = $_POST['email'];
        
        
        // Perform your query to insert the user details into the database
        
        $query = "INSERT INTO user (user_id, password, name, role, dob, contact_no, email) VALUES ('$user_id', '$hashed_password', '$name', '$role', '$dob', '$contact_num', '$email')";
        
        if ($connection->query($query) === TRUE) {
            // echo "<h2>Registration Successful</h2>";
            $registrationSuccessful = true;
            header("refresh:0;url=login.php?registrationSuccessful=true"); // refresh:1; Redirect to the login page after 1 seconds
            
            
        } else {
            echo "Error: " . $query . "<br>" . $connection->error;
        }
        

        $connection->close();
    }
    ?>
</body>
</html>
